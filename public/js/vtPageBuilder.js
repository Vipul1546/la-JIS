$('document').ready(function(){
	function deleteUI(){
        console.log('wroking');
    }

    var widgetStoreTop = $('.widgetStore').offset().top;
     $(window).scroll(function(){
     	if($(this).scrollTop()>=widgetStoreTop){
        	$('.widgetStore').addClass('fixTop').slideDown();
    	} else {
    		$('.widgetStore').removeClass('fixTop');
    	}
     });



    class vtDragDrop {

        constructor(dragEle, dropEle){
            this.dragEleKey = dragEle;
            this.dropEleKey = dropEle;

            this.counter = 0;
            this.playAreaCounter = 0;
            this.tree = '';
            this.lastTree = '';
        }

        doAlert(){
            var id = this.ele.attr('id');
            alert(id);
        }

        makeDraggable(){ 
            $('.widget').draggable({
                revert: "invalid",
                cursor: 'move',
                helper: 'clone',
                snap: true,
                zIndex: 100,
                refreshPositions: true,
                drag: function( event, ui ) { 
                	$('#myModalwidgetStore').css('top','-10000px');
                	$('.modal-backdrop').remove();
                },
                stop: function( event, ui ) { 
                	$('#myModalwidgetStore').css('top','inherit');
                	$('#myModalwidgetStore').modal('hide');
                },

            });
        }

        makeDroppable(newdropEleKey){ 
            var dropEleKey = (typeof newdropEleKey == 'undefined') ? this.dropEleKey : newdropEleKey;
            var dropEle = $(dropEleKey);
            var dropEleName = $(dropEleKey).attr('id');
            var self = this;

            dropEle.droppable({
                accept: self.dragEleKey,
                classes: {
					        "ui-droppable-hover": "ui-state-hover"
			      		},
                drop: function (event, ui) {
                    var target = $(event.target);
                    var dropped = $(ui.draggable).clone().appendTo(target);

                    

                    /* Adding Unique Id to dropped widget */
                    var id = dropped.attr('id')+'-'+dropEleName+'-'+self.counter;
                    dropped.addClass(id);
                    dropped.addClass('redrag');
                    dropped.find('.vt-close').attr('parentClass',id);
                    dropped.attr('widgetNumber',dropped.attr('id')+self.counter);
                    dropped.attr('parent', target.attr('pid'));

                    

                    /* Setting up edit model popup */
                    var modelID = id + '-model';
                    dropped.find('.editButton').attr('data-target', '#'+modelID);
                    dropped.find('.modal').attr('id', modelID);
                    dropped.find('.modal-footer button').attr('modelID', modelID);

                    /* Setting Widget Name for SAVEDATA */
                    var widgetName = dropped.attr('widgetName');
                    dropped.find('.widgetName').val(widgetName);
                    var widgetNumber = dropped.attr('widgetNumber');
                    dropped.find('.widgetNumber').val(widgetNumber);
                    dropped.find('.parentID').val(target.attr('pid'));
                    dropped.find('.selector').val(target.attr('id')); //setting droppable area value perticular widget

                    /*gennerate Input tree*/
                    if(typeof target.attr('pid') != 'undefined' && target.attr('pid') != self.lastTree){
                    	self.tree += ','+ target.attr('pid');
						while(self.tree.charAt(0) === ','){
					 		self.tree = self.tree.substr(1);
						}
                    }
                 	

                    dropped.attr('id',widgetNumber); //setting widget number as widget ID
                    dropped.find('.innerPlayArea').attr('pid',dropped.attr('id')); //setting widget id to dropArea



                    /* setting unique form values name */
                    var inputName = dropped.find('input');
                    var tree = '';
                    var parentTree =  self.tree.split(',');
                	for (var i = 0; i < parentTree.length; i++) {
                    		if(parentTree[i] != ''){
                    			tree +=  '['+parentTree[i]+']';
                		}
                	}
                    $.each( inputName, function( key, value ) {
                    	var UID = $(this).attr('name');
                    	//console.log(tree);
                    	$(this).attr('id', UID+self.counter);
                    	$(this).attr('name', 'widgetData['+widgetName+self.counter+']['+UID+']');
                    });
                    // $.each( inputName, function( key, value ) {
                    // 	var UID = $(this).attr('name');
                    // 	//console.log(tree);
                    // 	$(this).attr('id', UID+self.counter);
                    // 	if(widgetName == 'vt-row'){
                    // 		widgetName = widgetName + '-'; 
                    // 	}
                    // 	$(this).attr('name', widgetName+self.counter+'['+UID+']');
                    // });
                   
                    self.lastTree = target.attr('pid');
                    self.counter++;


                    /* Close Widget*/
                    $('.vt-close').click(function(){
                        $(this).parent().parent().parent().remove();
                    });

                    /* Setting title of widget on update */
                    $('.updateData').click(function(){
                        var newtitle = dropped.find('.vt-th').val();
                        dropped.find('.displayHeading').html('<span>'+newtitle+'</span>');
                    });

                    $('.updateRowData').click(function(){ 
                    		var modelID = $(this).attr('modelID');
                            var widgetName = $('#'+modelID+' .widgetName').val();
                            var widgetNumber = $('#'+modelID+' .widgetNumber').val();
                            var rowColumnCount = $('#'+widgetNumber+' #rowColumnCount').val();
                           $('#'+widgetNumber+' .dropBlock .row').hide();
                           $('#'+widgetNumber+' .'+rowColumnCount+'Row').css('display','flex');
                    });


                    /*
                    *
                    */
                    if (dropped.hasClass('redrag') && 0) { 
                        dropped.draggable({
                            revert: "invalid",
                            cursor: 'move',
                            snap: true,
                            drag: function( event, ui ) {
                                console.log();

                            }
                        });


                    }

                    /*
                    *
                    */
                    if (dropped.hasClass('drag')) { 
                        var newdropEleKey = dropped.find('.innerPlayArea');

                        $.each( newdropEleKey, function( key, value ) {
                        	var playAreaId = 'playArea'+self.playAreaCounter++;
					  		$(this).attr('id', playAreaId);
					  		self.makeDroppable($(this));
				  		 	$( this).droppable( "option", "greedy", true );
						});
                       
                        self.playAreaCounter++;
                    }

                },
            });
        }

    }



	let widget = new vtDragDrop('.widget', '#playArea');
	widget.makeDraggable();
	widget.makeDroppable();



    // $( ".widget" ).draggable({
    //     revert: "invalid",
    //     cursor: 'move',
    //     helper: 'clone',
    //     snap: true,
    // });

    // var counter = 0;
    // $("#playArea").droppable({
    //     accept: ".widget",
    //     drop: function (event, ui) {
    //         var target = $(event.target);
    //         var dropped = $(ui.draggable).clone().appendTo(target);

    //         var id = dropped.attr('id')+'-playArea-'+counter;
    //         dropped.addClass(id);
    //         dropped.find('.vt-close').attr('parentClass',id);
    //         dropped.attr('widgetNumber', counter);
    //         counter++;

    //         if (dropped.hasClass('drag')) {
    //             rowCounter = 0;
    //             dropped.find('.vt-rowPlayArea').droppable({
    //                 accept: ".widget",
    //                 greedy: true,
    //                 drop: function (event, ui) {
    //                     var target = $(event.target);
    //                     var dropped = $(ui.draggable).clone().appendTo(target);
    //                     var id = dropped.attr('id')+'-playArea-'+rowCounter;
    //                     dropped.addClass(id);
    //                     dropped.find('.vt-close').attr('parentClass',id);
    //                     dropped.attr('widgetNumber', rowCounter);
    //                     rowCounter++;

    //                     $('.vt-close').click(function(){ 
    //                         var parentClass = $(this).attr('parentClass');
    //                         $('.'+parentClass).remove();
    //                     });
    //                 },
    //             });
    //         }

    //         $('.vt-close').click(function(){ 
    //             var parentClass = $(this).attr('parentClass');
    //             $('.'+parentClass).remove();
    //         });

    //     },
    // });
        
});
        

        // $('#playArea').droppable(
        //         {
        //             accept: "#vt-row",
        //             drop: function(event, ui){
        //                 var droppable = $(this);
        //                 var draggable = ui.draggable;  
        //                 draggable.clone().appendTo(droppable);   
        //                 console.log(draggable.find('#vt-rowPlayArea'));
        //                 draggable.find('#vt-rowPlayArea').droppable(
        //                     {
        //                         accept: ".widget",
        //                         greedy: true,
        //                         drop: function(event, ui){
        //                             var droppable = $(this);
        //                             var draggable = ui.draggable;  

        //                             draggable.clone().appendTo(droppable);                                         
        //                         },
        //                     }
        //                 );                                          
        //             },
        //         }
        //     );

        // $('.vt-rowPlayArea').droppable(
        //         {
        //             accept: ".widget",
        //             greedy: true,
        //             drop: function(event, ui){
        //                 var droppable = $(this);
        //                 var draggable = ui.draggable;  

        //                 draggable.clone().appendTo(droppable);                                         
        //             },
        //         }
        //     );
