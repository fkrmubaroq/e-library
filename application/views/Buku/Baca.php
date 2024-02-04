<!DOCTYPE html>
<!--
Copyright 2012 Mozilla Foundation

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

Adobe CMap resources are covered by their own copyright but the same license:

    Copyright 1990-2015 Adobe Systems Incorporated.

See https://github.com/adobe-type-tools/cmap-resources
-->
<html dir="ltr" mozdisallowselectionprint>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="google" content="notranslate">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PDF.js viewer</title>


    <link rel="stylesheet" href="<?= base_url('assets/plugin/pdfjs/web/viewer.css') ?>">


    <!-- This snippet is used in production (included from viewer.html) -->
    <link rel="resource" type="application/l10n" href="<?= base_url('assets/plugin/pdfjs/web/') ?>locale/locale.properties">
    <script src="<?= base_url('assets/plugin/pdfjs/build/pdf.js') ?>" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">

    <style>
        html[dir="ltr"] .findbar {
            left: 13.5rem;
            top: 5rem;
        }
    </style>
</head>
</head>

<body>

    <div id='IdBuku' data-id="<?= $this->secure->encode($collection_buku->id) ?>"></div>

    <body tabindex="1" class="loadingInProgress">
        <div id="outerContainer">

            <div id="sidebarContainer" style=" padding-top:0; margin-top:1.6rem;">
                <div id="toolbarSidebar">
                    <div class="splitToolbarButton toggled">
                        <button id="viewThumbnail" class="toolbarButton toggled" title="Show Thumbnails" tabindex="2" data-l10n-id="thumbs">
                            <span data-l10n-id="thumbs_label">Thumbnails</span>
                        </button>
                        <button id="viewOutline" class="toolbarButton" title="Show Document Outline (double-click to expand/collapse all items)" tabindex="3" data-l10n-id="document_outline">
                            <span data-l10n-id="document_outline_label">Document Outline</span>
                        </button>
                        <button id="viewAttachments" class="toolbarButton" title="Show Attachments" tabindex="4" data-l10n-id="attachments">
                            <span data-l10n-id="attachments_label">Attachments</span>
                        </button>
                        <button id="viewLayers" class="toolbarButton" title="Show Layers (double-click to reset all layers to the default state)" tabindex="5" data-l10n-id="layers">
                            <span data-l10n-id="layers_label">Layers</span>
                        </button>
                    </div>
                </div>
                <div id="sidebarContent">
                    <div id="thumbnailView" class="w-100">
                    </div>
                    <div id="outlineView" class="hidden">
                    </div>
                    <div id="attachmentsView" class="hidden">
                    </div>
                    <div id="layersView" class="hidden">
                    </div>
                </div>
                <div id="sidebarResizer" class="hidden"></div>
            </div> <!-- sidebarContainer -->

            <div id="mainContainer">
                <div class="findbar hidden doorHanger" id="findbar">
                    <div id="findbarInputContainer">
                        <input id="findInput" class="toolbarField" title="Find" placeholder="Find in document…" tabindex="91" data-l10n-id="find_input">
                        <div class="splitToolbarButton">
                            <button id="findPrevious" class="toolbarButton findPrevious" title="Find the previous occurrence of the phrase" tabindex="92" data-l10n-id="find_previous">
                                <span data-l10n-id="find_previous_label">Previous</span>
                            </button>
                            <div class="splitToolbarButtonSeparator"></div>
                            <button id="findNext" class="toolbarButton findNext" title="Find the next occurrence of the phrase" tabindex="93" data-l10n-id="find_next">
                                <span data-l10n-id="find_next_label">Next</span>
                            </button>
                        </div>
                    </div>

                    <div id="findbarOptionsOneContainer">
                        <input type="checkbox" id="findHighlightAll" class="toolbarField" tabindex="94">
                        <label for="findHighlightAll" class="toolbarLabel" data-l10n-id="find_highlight">Highlight all</label>
                        <input type="checkbox" id="findMatchCase" class="toolbarField" tabindex="95">
                        <label for="findMatchCase" class="toolbarLabel" data-l10n-id="find_match_case_label">Match case</label>
                    </div>
                    <div id="findbarOptionsTwoContainer">
                        <input type="checkbox" id="findEntireWord" class="toolbarField" tabindex="96">
                        <label for="findEntireWord" class="toolbarLabel" data-l10n-id="find_entire_word_label">Whole words</label>
                        <span id="findResultsCount" class="toolbarLabel hidden"></span>
                    </div>

                    <div id="findbarMessageContainer">
                        <span id="findMsg" class="toolbarLabel"></span>
                    </div>
                </div> <!-- findbar -->

                <div id="secondaryToolbar" class="secondaryToolbar hidden doorHangerRight">
                    <div id="secondaryToolbarButtonContainer">
                        <button id="secondaryPresentationMode" class="secondaryToolbarButton presentationMode visibleLargeView" title="Switch to Presentation Mode" tabindex="51" data-l10n-id="presentation_mode">
                            <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
                        </button>

                        <button id="secondaryOpenFile" class="secondaryToolbarButton openFile visibleLargeView" title="Open File" tabindex="52" data-l10n-id="open_file">
                            <span data-l10n-id="open_file_label">Open</span>
                        </button>

                        <button id="secondaryPrint" class="secondaryToolbarButton print visibleMediumView" title="Print" tabindex="53" data-l10n-id="print">
                            <span data-l10n-id="print_label">Print</span>
                        </button>

                        <span id="secondaryDownload" class="secondaryToolbarButton download visibleMediumView" title="Download" tabindex="54" data-l10n-id="download">
                        </span>

                        <a href="#" id="secondaryViewBookmark" class="secondaryToolbarButton bookmark visibleSmallView" title="Current view (copy or open in new window)" tabindex="55" data-l10n-id="bookmark">
                            <span data-l10n-id="bookmark_label">Current View</span>
                        </a>

                        <div class="horizontalToolbarSeparator visibleLargeView"></div>

                        <button id="firstPage" class="secondaryToolbarButton firstPage" title="Go to First Page" tabindex="56" data-l10n-id="first_page">
                            <span data-l10n-id="first_page_label">Go to First Page</span>
                        </button>
                        <button id="lastPage" class="secondaryToolbarButton lastPage" title="Go to Last Page" tabindex="57" data-l10n-id="last_page">
                            <span data-l10n-id="last_page_label">Go to Last Page</span>
                        </button>

                        <div class="horizontalToolbarSeparator"></div>

                        <button id="pageRotateCw" class="secondaryToolbarButton rotateCw" title="Rotate Clockwise" tabindex="58" data-l10n-id="page_rotate_cw">
                            <span data-l10n-id="page_rotate_cw_label">Rotate Clockwise</span>
                        </button>
                        <button id="pageRotateCcw" class="secondaryToolbarButton rotateCcw" title="Rotate Counterclockwise" tabindex="59" data-l10n-id="page_rotate_ccw">
                            <span data-l10n-id="page_rotate_ccw_label">Rotate Counterclockwise</span>
                        </button>

                        <div class="horizontalToolbarSeparator"></div>

                        <button id="cursorSelectTool" class="secondaryToolbarButton selectTool toggled" title="Enable Text Selection Tool" tabindex="60" data-l10n-id="cursor_text_select_tool">
                            <span data-l10n-id="cursor_text_select_tool_label">Text Selection Tool</span>
                        </button>
                        <button id="cursorHandTool" class="secondaryToolbarButton handTool" title="Enable Hand Tool" tabindex="61" data-l10n-id="cursor_hand_tool">
                            <span data-l10n-id="cursor_hand_tool_label">Hand Tool</span>
                        </button>

                        <div class="horizontalToolbarSeparator"></div>

                        <button id="scrollVertical" class="secondaryToolbarButton scrollModeButtons scrollVertical toggled" title="Use Vertical Scrolling" tabindex="62" data-l10n-id="scroll_vertical">
                            <span data-l10n-id="scroll_vertical_label">Vertical Scrolling</span>
                        </button>
                        <button id="scrollHorizontal" class="secondaryToolbarButton scrollModeButtons scrollHorizontal" title="Use Horizontal Scrolling" tabindex="63" data-l10n-id="scroll_horizontal">
                            <span data-l10n-id="scroll_horizontal_label">Horizontal Scrolling</span>
                        </button>
                        <button id="scrollWrapped" class="secondaryToolbarButton scrollModeButtons scrollWrapped" title="Use Wrapped Scrolling" tabindex="64" data-l10n-id="scroll_wrapped">
                            <span data-l10n-id="scroll_wrapped_label">Wrapped Scrolling</span>
                        </button>

                        <div class="horizontalToolbarSeparator scrollModeButtons"></div>

                        <button id="spreadNone" class="secondaryToolbarButton spreadModeButtons spreadNone toggled" title="Do not join page spreads" tabindex="65" data-l10n-id="spread_none">
                            <span data-l10n-id="spread_none_label">No Spreads</span>
                        </button>
                        <button id="spreadOdd" class="secondaryToolbarButton spreadModeButtons spreadOdd" title="Join page spreads starting with odd-numbered pages" tabindex="66" data-l10n-id="spread_odd">
                            <span data-l10n-id="spread_odd_label">Odd Spreads</span>
                        </button>
                        <button id="spreadEven" class="secondaryToolbarButton spreadModeButtons spreadEven" title="Join page spreads starting with even-numbered pages" tabindex="67" data-l10n-id="spread_even">
                            <span data-l10n-id="spread_even_label">Even Spreads</span>
                        </button>

                        <div class="horizontalToolbarSeparator spreadModeButtons"></div>

                        <button id="documentProperties" class="secondaryToolbarButton documentProperties" title="Document Properties…" tabindex="68" data-l10n-id="document_properties">
                            <span data-l10n-id="document_properties_label">Document Properties…</span>
                        </button>
                    </div>
                </div> <!-- secondaryToolbar -->

                <div class="toolbar">
                    <div id="toolbarContainer" style="height:5rem">
                        <div id="toolbarViewer" class="d-flex align-items-center justify-content-between bg-light box-shadow" style="height:5rem;">
                            <div id="toolbarViewerLeft">
                                <!-- LOGO -->
                                <div class='logo margin-left-4 d-flex margin-right-5'>
                                    <img src="<?= base_url('assets/img/logo.png') ?>" width=25>
                                    <div class="d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block">
                                        <div class=' d-flex align-content-center margin-top-2 margin-left-3 '>
                                            <h4 class='fweight-600'>SMK Merdeka</h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- /LOGO -->

                                <div class="splitToolbarButton hiddenSmallView">
                                    <button class="toolbarButton pageUp" title="Previous Page" id="previous" tabindex="13" data-l10n-id="previous">
                                        <span data-l10n-id="previous_label">Previous</span>
                                    </button>
                                    <div class="splitToolbarButtonSeparator"></div>
                                    <button class="toolbarButton pageDown" title="Next Page" id="next" tabindex="14" data-l10n-id="next">
                                        <span data-l10n-id="next_label">Next</span>
                                    </button>
                                </div>
                                <input type="number" id="pageNumber" class="toolbarField pageNumber" title="Page" value="1" size="4" min="1" tabindex="15" data-l10n-id="page" autocomplete="off">
                                <span id="numPages" class="toolbarLabel"></span>


                                <button id="viewFind" class="toolbarButton" title="Find in Document" tabindex="12" data-l10n-id="findbar">
                                    <span data-l10n-id="findbar_label">Find</span>
                                </button>

                            </div>
                            <div id="toolbarViewerRight">
                                <button id="presentationMode" class="toolbarButton presentationMode hiddenLargeView" title="Switch to Presentation Mode" tabindex="31" data-l10n-id="presentation_mode">
                                    <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
                                </button>
                                <button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="11" data-l10n-id="toggle_sidebar">
                                    <span data-l10n-id="toggle_sidebar_label">Toggle Sidebar</span>
                                </button>
                                <div class="toolbarButtonSpacer"></div>



                                <span id="openFile" class="hiddenLargeView">
                                </span>

                                <span id="print" class=" print hiddenMediumView">
                                </span>

                                <span id="download" class="download hiddenMediumView">
                                </span>
                                <span id="viewBookmark" class="bookmark hiddenSmallView">
                                </span>

                                <div class="verticalToolbarSeparator hiddenSmallView"></div>

                                <button id="secondaryToolbarToggle" class="toolbarButton" title="Tools" tabindex="36" data-l10n-id="tools">
                                    <span data-l10n-id="tools_label">Tools</span>
                                </button>
                            </div>
                            <div id="toolbarViewerMiddle">
                                <div class="splitToolbarButton">
                                    <button id="zoomOut" class="toolbarButton zoomOut" title="Zoom Out" tabindex="21" data-l10n-id="zoom_out">
                                        <span data-l10n-id="zoom_out_label">Zoom Out</span>
                                    </button>
                                    <div class="splitToolbarButtonSeparator"></div>
                                    <button id="zoomIn" class="toolbarButton zoomIn" title="Zoom In" tabindex="22" data-l10n-id="zoom_in">
                                        <span data-l10n-id="zoom_in_label">Zoom In</span>
                                    </button>
                                </div>
                                <span id="scaleSelectContainer" class="dropdownToolbarButton">
                                    <select id="scaleSelect" title="Zoom" tabindex="23" data-l10n-id="zoom">
                                        <option id="pageAutoOption" title="" value="auto" selected="selected" data-l10n-id="page_scale_auto">Automatic Zoom</option>
                                        <option id="pageActualOption" title="" value="page-actual" data-l10n-id="page_scale_actual">Actual Size</option>
                                        <option id="pageFitOption" title="" value="page-fit" data-l10n-id="page_scale_fit">Page Fit</option>
                                        <option id="pageWidthOption" title="" value="page-width" data-l10n-id="page_scale_width">Page Width</option>
                                        <option id="customScaleOption" title="" value="custom" disabled="disabled" hidden="true"></option>
                                        <option title="" value="0.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 50 }'>50%</option>
                                        <option title="" value="0.75" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 75 }'>75%</option>
                                        <option title="" value="1" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 100 }'>100%</option>
                                        <option title="" value="1.25" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 125 }'>125%</option>
                                        <option title="" value="1.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 150 }'>150%</option>
                                        <option title="" value="2" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 200 }'>200%</option>
                                        <option title="" value="3" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 300 }'>300%</option>
                                        <option title="" value="4" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 400 }'>400%</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div id="loadingBar">
                            <div class="progress">
                                <div class="glimmer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <menu type="context" id="viewerContextMenu">
                    <menuitem id="contextFirstPage" label="First Page" data-l10n-id="first_page">
                    </menuitem>
                    <menuitem id="contextLastPage" label="Last Page" data-l10n-id="last_page">
                    </menuitem>
                    <menuitem id="contextPageRotateCw" label="Rotate Clockwise" data-l10n-id="page_rotate_cw">
                    </menuitem>
                    <menuitem id="contextPageRotateCcw" label="Rotate Counter-Clockwise" data-l10n-id="page_rotate_ccw">
                    </menuitem>
                </menu>

                <div id="viewerContainer" tabindex="0">
                    <div id="viewer" class="pdfViewer margin-top-7"></div>
                </div>

                <div id="errorWrapper" hidden='true'>
                    <div id="errorMessageLeft">
                        <span id="errorMessage"></span>
                        <button id="errorShowMore" data-l10n-id="error_more_info">
                            More Information
                        </button>
                        <button id="errorShowLess" data-l10n-id="error_less_info" hidden='true'>
                            Less Information
                        </button>
                    </div>
                    <div id="errorMessageRight">
                        <button id="errorClose" data-l10n-id="error_close">
                            Close
                        </button>
                    </div>
                    <div class="clearBoth"></div>
                    <textarea id="errorMoreInfo" hidden='true' readonly="readonly"></textarea>
                </div>
            </div> <!-- mainContainer -->

            <div id="overlayContainer" class="hidden">
                <div id="passwordOverlay" class="container hidden">
                    <div class="dialog">
                        <div class="row">
                            <p id="passwordText" data-l10n-id="password_label">Enter the password to open this PDF file:</p>
                        </div>
                        <div class="row">
                            <input type="password" id="password" class="toolbarField">
                        </div>
                        <div class="buttonRow">
                            <button id="passwordCancel" class="overlayButton"><span data-l10n-id="password_cancel">Cancel</span></button>
                            <button id="passwordSubmit" class="overlayButton"><span data-l10n-id="password_ok">OK</span></button>
                        </div>
                    </div>
                </div>
                <div id="documentPropertiesOverlay" class="container hidden">
                    <div class="dialog">
                        <div class="row">
                            <span data-l10n-id="document_properties_file_name">File name:</span>
                            <p id="fileNameField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_file_size">File size:</span>
                            <p id="fileSizeField">-</p>
                        </div>
                        <div class="separator"></div>
                        <div class="row">
                            <span data-l10n-id="document_properties_title">Title:</span>
                            <p id="titleField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_author">Author:</span>
                            <p id="authorField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_subject">Subject:</span>
                            <p id="subjectField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_keywords">Keywords:</span>
                            <p id="keywordsField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_creation_date">Creation Date:</span>
                            <p id="creationDateField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_modification_date">Modification Date:</span>
                            <p id="modificationDateField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_creator">Creator:</span>
                            <p id="creatorField">-</p>
                        </div>
                        <div class="separator"></div>
                        <div class="row">
                            <span data-l10n-id="document_properties_producer">PDF Producer:</span>
                            <p id="producerField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_version">PDF Version:</span>
                            <p id="versionField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_page_count">Page Count:</span>
                            <p id="pageCountField">-</p>
                        </div>
                        <div class="row">
                            <span data-l10n-id="document_properties_page_size">Page Size:</span>
                            <p id="pageSizeField">-</p>
                        </div>
                        <div class="separator"></div>
                        <div class="row">
                            <span data-l10n-id="document_properties_linearized">Fast Web View:</span>
                            <p id="linearizedField">-</p>
                        </div>
                        <div class="buttonRow">
                            <button id="documentPropertiesClose" class="overlayButton"><span data-l10n-id="document_properties_close">Close</span></button>
                        </div>
                    </div>
                </div>
                <div id="printServiceOverlay" class="container hidden">
                    <div class="dialog">
                        <div class="row">
                            <span data-l10n-id="print_progress_message">Preparing document for printing…</span>
                        </div>
                        <div class="row">
                            <progress value="0" max="100"></progress>
                            <span data-l10n-id="print_progress_percent" data-l10n-args='{ "progress": 0 }' class="relative-progress">0%</span>
                        </div>
                        <div class="buttonRow">
                            <button id="printCancel" class="overlayButton"><span data-l10n-id="print_progress_close">Cancel</span></button>
                        </div>
                    </div>
                </div>
            </div> <!-- overlayContainer -->

            <?php if ($access == 'trial') : ?>
                <div class='position-fixed padding-x-7 padding-y-3 bg-dark box-shadow' style="bottom:40px; right:50px; ">
                    <h4 class='text-white'>Akses buku ini dibatasi, silahkan lakukan peminjaman buku</h4>
                </div>
            <?php endif; ?>

        </div> <!-- outerContainer -->
        <div id="printContainer"></div>
    </body>
    <script src="<?= base_url('assets/plugin/pdfjs/web/viewer.js') ?>" defer></script>
    <script src="<?= base_url('assets/js/BacaBuku.js') ?>"></script>