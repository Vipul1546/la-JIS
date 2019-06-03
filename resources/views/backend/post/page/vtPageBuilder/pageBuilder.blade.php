<vtPageBuilder class="container">
	<div id="widgetStore" class="widgetStore ">
	    <div class="row">
		    <div class="col-sm">
				<button type="button" class="btn btn-primary editButton" data-toggle="modal" data-target="#myModalwidgetStore">
			        <i class="fas fa-store"></i> Widget Store
			    </button>
	    		<!-- The Modal -->
	            <div class="modal fade bd-example-modal-lg" id="myModalwidgetStore">
	                <div class="modal-dialog modal-lg">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                            <h4 class="modal-title">Widget Store <i class="fas fa-store"></i></h4>
	                            <button type="button" class="close" data-dismiss="modal">&times;</button>
	                        </div>
	                        <div class="modal-body">
	                             <div class="row">
							    	@include('backend.post.page.vtPageBuilder.widgets.row')
							    	@include('backend.post.page.vtPageBuilder.widgets.textHeading')
							    </div>
	                        </div>
	                        <div class="modal-footer">
	                            <button class="closeWidgetStore" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
    </div>

	<div id="playArea" class="playArea container">
	       
	</div> 
</vtPageBuilder>