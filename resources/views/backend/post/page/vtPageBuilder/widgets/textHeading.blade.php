<!--
    *
    * WIDGET NAME: HEADING WIDGET 
    *
-->
            <div id="vt-textHeading" class="widget vt-textHeading col" widgetName="Text Heading">
                <div class="vt-WidgetHeading row">
                    <div class="displayHeading col-sm-8">
                        Text Heading
                    </div>
                    <div class="editBox  text-center whide col-sm-4">
                        <button type="button" class="btn btn-primary editButton tranparentBG" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-pen-fancy"></i>
                        </button>
                        <button type="button" class="btn vt-close btn-danger">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Heading</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input class="widgetName" type="hidden" name="widgetName" value="">
                                <div id="vt-textHeadingExpand">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Heading Text</span>
                                        </div>
                                        <input type="text" value="Heading Text" class="form-control vt-th" name="vt-th" aria-label="text heading">
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Heading Color Code</span>
                                        </div>
                                        <input type="text" value="#333" class="form-control vt-cc" name="vt-cc" aria-label="text heading">
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Heading Font Size</span>
                                        </div>
                                        <input type="text" value="15px" class="form-control vt-fs" name="vt-fs" aria-label="text heading">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="updateData" type="button" class="btn btn-danger" data-dismiss="modal">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
