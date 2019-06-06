<!--
    *
    * WIDGET NAME: ROW WIDGET 
    *
-->
            <div id="vt-row" class="widget vt-row col drag" widgetName="vt-row">
                <div class="vt-WidgetHeading row">
                    <div class="displayHeading col-sm-8">
                        Add Row
                    </div>
                    <div class="editBox text-center whide col-sm-4">
                        <button type="button" class="btn btn-primary editButton tranparentBG" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-pen-fancy"></i>
                        </button>                    
                        <button id="asdf" type="button" class="btn vt-close btn-danger">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="container afterDrop">
                    <div class="container dropBlock">

                        <!-- FULL WIDTH ROW -->
                        <div class="12Row row">
                            <div class="col-md-12">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                        </div>

                        <!-- 1/2 WIDTH ROW -->
                        <div class="6Row row" style="display: none;">
                            <div class="col-md-6">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                        </div>

                        <!-- 1/3 WIDTH ROW -->
                        <div class="4Row row " style="display: none;">
                            <div class="col-md-4">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                        </div>

                        <!-- 1/4 WIDTH ROW -->
                        <div class="3Row row " style="display: none;">
                            <div class="col-md-3">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="innerPlayArea dropArea">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- The Setting Modal -->
                <div class="modal fade bd-example-modal-lg" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">ROW</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input class="selector" type="hidden" name="selector" value="">
                                <input class="widgetName" type="hidden" name="widgetName" value="">
                                <input class="widgetNumber" type="hidden" name="widgetNumber" value="">
                                <input class="parentID" type="hidden" name="parentID" value="">
                                <div id="vt-textHeadingExpand">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="rowColumnCount">Number of column</label>
                                        </div>
                                        <select class="custom-select" id="rowColumnCount" name="rowColumnCount">
                                            <option selected>Choose...</option>
                                            <option value="12">One</option>
                                            <option value="6">Two</option>
                                            <option value="4">Three</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" id="disableFrontend" aria-label="Checkbox for following text input" name="disableFrontend">
                                            </div>
                                        </div>
                                        <span class="input-group-text">Hide in frontend</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="updateRowData" type="button" class="btn btn-danger" data-dismiss="modal">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                // var selector = $('.selector').val();
                // console.log(selector);
                // $(document).ready(function(){
                //     $("#playArea" ).on( "drop", function( event, ui ) { 
                //         $('.updateRowData').click(function(){ alert('asdf');
                //             var widgetName = $('.widgetName').val();
                //             var widgetNumber = $('.widgetNumber').val();
                //             var rowColumnCount = $('#'+widgetNumber+' #rowColumnCount').val();
                //             console.log(rowColumnCount);
                //         });
                //     });
                // });     


                
            </script>
