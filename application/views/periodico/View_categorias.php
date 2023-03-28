<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categorias
                            <small>Aqui podras editar toda la información de las categorias del periodico Patria Masferreriana</small>
                        </h2>
                        <ul class="header-dropdown m-r--5" >
                                <li class="dropdown ">
                                    <a aria-expanded="true" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button">
                                        <i class="material-icons waves-effect bg-<?php echo $tema; ?>" style="font-size: 30px" id="add">
                                            add_circle
                                        </i>
                                    </a>
                                </li>
                            </ul>
                    </div>
                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <div class="body table-responsive">
                                <table id="tb-categoria"class="table table-bordered table-striped table-condensed">
                                    <thead class="">
                                        <tr>
                                            <th>CORRELATIVO</th>
                                            <th>NOTICIA</th>
                                            <th>ICONO</th>
                                            
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                </div>
                                <div class="form-actions">
                                    <div class="text-center paginacion">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>



<div class="modal fade" id="create_form_modal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="form-title"></h4>
            </div>
            <div class="modal-body"> 
            <div id="carga"></div>
                <form  id="developer_cu_form">
                    <div class="modal-body users-cont">
                        <div class="row clearfix">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">bookmark</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Categoria" id="categoria" name="categoria">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">fast_forward</i>
                                </span>
                                <div>
                                    <select name="icono" id="icono"  data-live-search="true" style="width: 100%;">
                                        <option value="" selected="selected">*Seleccione Icono*</option>
                                        <option value="fa fa-facebook" data-icon="fa fa-facebook">Facebook</option>
                                        <option value="fa fa-twitter" data-icon="fa fa-twitter">Twitter</option>
                                        <option value="fa fa-instagram"data-icon="fa fa-instagram">Instagram</option>
                                        <option value="fa fa-users" data-icon="fa fa-users">Youtube</option>
                                        <option value="fa fa-whatsapp" data-icon="fa fa-whatsapp">Whatsapp</option>
                                        <option value="fa fa-align-left" data-icon="fa fa-align-left"> fa-align-left</option>
                                        <option value="fa fa-align-right" data-icon="fa fa-align-right"> fa-align-right</option>
                                        <option value="fa fa-amazon" data-icon="fa fa-amazon"> fa-amazon</option>
                                        <option value="fa fa-ambulance" data-icon="fa fa-ambulance"> fa-ambulance</option>
                                        <option value="fa fa-anchor" data-icon="fa fa-anchor">fa-anchor</option>
                                        <option value="fa fa-android" data-icon="fa fa-android"> fa-android</option>
                                        <option value="fa fa-angellist" data-icon="fa fa-angellist"> fa-angellist</option>
                                        <option value="fa fa-angle-double-down" data-icone="fa fa-angle-double-down"> fa-angle-double-down</option>
                                        <option value="fa fa-angle-double-left" data-icon="fa fa-angle-double-left"> fa-angle-double-left</option>
                                        <option value="fa fa-angle-double-right" data-icon="fa fa-angle-double-right"> fa-angle-double-right</option>
                                        <option value="fa fa-angle-double-up" data-icon="fa fa-angle-double-up"> fa-angle-double-up</option>

                                        <option value="fa fa fa-angle-left"data-icon="fa fa fa-angle-left"> fa-angle-left</option>
                                        <option value="fa fa-angle-right"data-icon="fa fa-angle-right"> fa-angle-right</option>
                                        <option value="fa fa-angle-up"data-icon="fa fa-angle-up"> fa-angle-up</option>
                                        <option value="fa fa-apple"data-icon="fa fa-apple"> fa-apple</option>
                                        <option value="fa fa-archive"data-icon="fa fa-archive"> fa-archive</option>
                                        <option value="fa fa-area-chart"data-icon="fa fa-area-chart"> fa-area-chart</option>
                                        <option value="fa fa-arrow-circle-down"data-icon="fa fa-arrow-circle-down">fa-arrow-circle-down</option>
                                        <option value="fa fa-arrow-circle-left"data-icon="fa fa-arrow-circle-left"> fa-arrow-circle-left</option>
                                        <option value="fa fa-arrow-circle-o-down"data-icon="fa fa-arrow-circle-o-down"> fa-arrow-circle-o-down</option>
                                        <option value="fa fa-arrow-circle-o-left"data-icon="fa fa-arrow-circle-o-left"> fa-arrow-circle-o-left</option>
                                        <option value="fa fa-arrow-circle-o-right"data-icon="fa fa-arrow-circle-o-right"> fa-arrow-circle-o-right</option>
                                        <option value="fa fa-arrow-circle-o-up"data-icon="fa fa-arrow-circle-o-up"> fa-arrow-circle-o-up</option>
                                        <option value="fa fa-arrow-circle-right"data-icon="fa fa-arrow-circle-right"> fa-arrow-circle-right</option>
                                        <option value="fa fa-arrow-circle-up"data-icon="fa fa-arrow-circle-up"> fa-arrow-circle-up</option>
                                        <option value="fa fa-arrow-down"data-icon="fa fa-arrow-down"> fa-arrow-down</option>
                                        <option value="fa fa-arrow-left"data-icon="fa fa-arrow-left"> fa-arrow-left</option>
                                        <option value="fa fa-arrow-right"data-icon="fa fa-arrow-right"> fa-arrow-right</option>
                                        <option value="fa fa-arrow-up"data-icon="fa fa-arrow-up"> fa-arrow-up</option>
                                        <option value="fa fa-arrows"data-icon="fa fa-arrows"> fa-arrows</option>
                                        <option value="fa fa-arrows-alt"data-icon="fa fa-arrows-alt"> fa-arrows-alt</option>
                                        <option value="fa fa-arrows-h"data-icon="fa fa-arrows-h"> fa-arrows-h</option>
                                        <option value="fa fa-arrows-v"data-icon="fa fa-arrows-v"> fa-arrows-v</option>
                                        <option value="fa fa-asterisk"data-icon="fa fa-asterisk"> fa-asterisk</option>
                                        <option value="fa fa-at"data-icon="fa fa-at"> fa-at</option>
                                        <option value="fa fa-automobile"data-icon="fa fa-automobile"> fa-automobile</option>
                                        <option value="fa fa-backward"data-icon="fa fa-backward"> fa-backward</option>
                                        <option value="fa fa-balance-scale"data-icon="fa fa-balance-scale"> fa-balance-scale</option>
                                        <option value="fa fa-ban"data-icon="fa fa-ban"> fa-ban</option>
                                        <option value="fa fa-bank"data-icon="fa fa-bank"> fa-bank</option>
                                        <option value="fa fa-bar-chart"data-icon="fa fa-bar-chart"> fa-bar-chart</option>
                                        <option value="fa fa-bar-chart-o"data-icon="fa fa-bar-chart-o"> fa-bar-chart-o</option>

                                        <option value="fa fa-battery-full"data-icon="fa fa-battery-full"> fa-battery-full</option>
                                        <option value="fa fa-behance"data-icon="fa fa-behance"> fa-behance</option>
                                        <option value="fa fa-behance-square"data-icon="fa fa-behance-square"> fa-behance-square</option>
                                        <option value="fa fa-bell"data-icon="fa fa-bell"> fa-bell</option>
                                        <option value="fa fa-bell-o"data-icon="fa fa-bell-o"> fa-bell-o</option>
                                        <option value="fa fa-bell-slash"data-icon="fa fa-bell-slash"> fa-bell-slash</option>
                                        <option value="fa fa-bell-slash-o"data-icon="fa fa-bell-slash-o"> fa-bell-slash-o</option>
                                        <option value="fa fa-bicycle"data-icon="fa fa-bicycle"> fa-bicycle</option>
                                        <option value="fa fa-binoculars"data-icon="fa fa-binoculars"> fa-binoculars</option>
                                        <option value="fa fa-birthday-cake"data-icon="fa fa-birthday-cake"> fa-birthday-cake</option>
                                        <option value="fa fa-bitbucket"data-icon="fa fa-bitbucket"> fa-bitbucket</option>
                                        <option value="fa fa-bitbucket-square"data-icon="fa fa-bitbucket-square"> fa-bitbucket-square</option>
                                        <option value="fa fa-bitcoin"data-icon="fa fa-bitcoin"> fa-bitcoin</option>
                                        <option value="fa fa-black-tie"data-icon="fa fa-black-tie"> fa-black-tie</option>
                                        <option value="fa fa-bold"data-icon="fa fa-bold"> fa-bold</option>
                                        <option value="fa fa-bolt"data-icon="fa fa-bolt"> fa-bolt</option>
                                        <option value="fa fa-bomb"data-icon="fa fa-bomb"> fa-bomb</option>
                                        <option value="fa fa-book"data-icon="fa fa-book"> fa-book</option>
                                        <option value="fa fa-bookmark"data-icon="fa fa-bookmark"> fa-bookmark</option>
                                        <option value="fa fa-bookmark-o"data-icon="fa fa-bookmark-o"> fa-bookmark-o</option>
                                        <option value="fa fa-briefcase"data-icon="fa fa-briefcase"> fa-briefcase</option>
                                        <option value="fa fa-btc"data-icon="fa fa-btc"> fa-btc</option>
                                        <option value="fa fa-bug"data-icon="fa fa-bug"> fa-bug</option>
                                        <option value="fa fa-building"data-icon="fa fa-building"> fa-building</option>
                                        <option value="fa fa-building-o"data-icon="fa fa-building-o"> fa-building-o</option>
                                        <option value="fa fa-bullhorn"data-icon="fa fa-bullhorn"> fa-bullhorn</option>
                                        <option value="fa fa-bullseye"data-icon="fa fa-bullseye"> fa-bullseye</option>
                                        <option value="fa fa-bus"data-icon="fa fa-bus"> fa-bus</option>
                                        <option value="fa fa-cab"data-icon="fa fa-cab"> fa-cab</option>
                                        <option value="fa fa-calendar"data-icon="fa fa-calendar"> fa-calendar</option>
                                        <option value="fa fa-camera"data-icon="fa fa-camera"> fa-camera</option>
                                        <option value="fa fa-car"data-icon="fa fa-car"> fa-car</option>
                                        <option value="fa fa-caret-up"data-icon="fa fa-caret-up"> fa-caret-up</option>
                                        <option value="fa fa-cart-plus"data-icon="fa fa-cart-plus"> fa-cart-plus</option>
                                        <option value="fa fa fa-cc"data-icon="fa fa fa-cc"> fa-cc</option>
                                        <option value="fa fa-cc-amex"data-icon="fa fa-cc-amex"> fa-cc-amex</option>
                                        <option value="fa fa-cc-jcb"data-icon="fa fa-cc-jcb"> fa-cc-jcb</option>
                                        <option value="fa fa-cc-paypal"data-icon="fa fa-cc-paypal"> fa-cc-paypal</option>
                                        <option value="fa fa-cc-stripe"data-icon="fa fa-cc-stripe"> fa-cc-stripe</option>
                                        <option value="fa fa-cc-visa"data-icon="fa fa-cc-visa"> fa-cc-visa</option>
                                        <option value="fa fa-check"data-icon="fa fa-check"> fa-check</option>
                                        <option value="fa fa-chevron-left"data-icon="fa fa-chevron-left"> fa-chevron-left</option>
                                        <option value="fa fa-chevron-right"data-icon="fa fa-chevron-right"> fa-chevron-right</option>
                                        <option value="fa fa-chevron-up"data-icon="fa fa-chevron-up"> fa-chevron-up</option>
                                        <option value="fa fa-child"data-icon="fa fa-child">fa-child</option>
                                        <option value="fa fa-chrome"data-icon="fa fa-chrome"> fa-chrome</option>
                                        <option value="fa fa-circle"data-icon="fa fa-circle"> fa-circle</option>
                                        <option value="fa fa-circle-o"data-icon="fa fa-circle-o"> fa-circle-o</option>
                                        <option value="fa fa-circle-o-notch"data-icon="fa fa-circle-o-notch"> fa-circle-o-notch</option>
                                        <option value="fa fa-circle-thin"data-icon="fa fa-circle-thin"> fa-circle-thin</option>
                                        <option value="fa fa-clipboard"data-icon="fa fa-clipboard"> fa-clipboard</option>
                                        <option value="fa fa-clock-o"data-icon="fa fa-clock-o"> fa-clock-o</option>
                                        <option value="fa fa-clone"data-icon="fa fa-clone"> fa-clone</option>
                                        <option value="fa fa-close"data-icon="fa fa-close"> fa-close</option>
                                        <option value="fa fa-cloud"data-icon="fa fa-cloud"> fa-cloud</option>
                                        <option value="fa fa-cloud-download"data-icon="fa fa-cloud-download"> fa-cloud-download</option>
                                        <option value="fa fa-cloud-upload"data-icon="fa fa-cloud-upload"> fa-cloud-upload</option>
                                        <option value="fa fa-cny"data-icon="fa fa-cny"> fa-cny</option>
                                        <option value="fa fa-code"data-icon="fa fa-code"> fa-code</option>
                                        <option value="fa fa-code-fork"data-icon="fa fa-code-fork"> fa-code-fork</option>
                                        <option value="fa fa-codepen"data-icon="fa fa-codepen"> fa-codepen</option>
                                        <option value="fa fa-coffee"data-icon="fa fa-coffee"> fa-coffee</option>
                                        <option value="fa fa-cog"data-icon="fa fa-cog"> fa-cog</option>
                                        <option value="fa fa-cogs"data-icon="fa fa-cogs"> fa-cogs</option>
                                        <option value="fa fa-columns"data-icon="fa fa-columns"> fa-columns</option>
                                        <option value="fa fa-comment"data-icon="fa fa-comment"> fa-comment</option>
                                        <option value="fa fa-comment-o"data-icon="fa fa-comment-o"> fa-comment-o</option>
                                        <option value="fa fa-commenting"data-icon="fa fa-commenting"> fa-commenting</option>
                                        <option value="fa fa-commenting-o"data-icon="fa fa-commenting-o"> fa-commenting-o</option>
                                        <option value="fa fa-comments"data-icon="fa fa-comments"> fa-comments</option>
                                        <option value="fa fa-comments-o"data-icon="fa fa-comments-o"> fa-comments-o</option>
                                        <option value="fa fa-compass"data-icon="fa fa-compass"> fa-compass</option>
                                        <option value="fa fa-compress"data-icon="fa fa-compress"> fa-compress</option>
                                        <option value="fa fa-connectdevelop"data-icon="fa fa-connectdevelop"> fa-connectdevelop</option>
                                        <option value="fa fa-contao"data-icon="fa fa-contao"> fa-contao</option>
                                        <option value="fa fa-copy"data-icon="fa fa-copy"> fa-copy</option>
                                        <option value="fa fa-copyright"data-icon="fa fa-copyright"> fa-copyright</option>
                                        <option value="fa fa-creative-commons"data-icon="fa fa-creative-commons"> fa-creative-commons</option>
                                        <option value="fa fa-credit-card"data-icon="fa fa-credit-card"> fa-credit-card</option>
                                        <option value="fa fa-crop"data-icon="fa fa-crop"> fa-crop</option>
                                        <option value="fa fa-crosshairs"data-icon="fa fa-crosshairs"> fa-crosshairs</option>
                                        <option value="fa fa-css3"data-icon="fa fa-css3"> fa-css3</option>
                                        <option value="fa fa-cube"data-icon="fa fa-cube"> fa-cube</option>
                                        <option value="fa fa-cubes"data-icon="fa fa-cubes"> fa-cubes</option>
                                        <option value="fa fa-cut"data-icon="fa fa-cut"> fa-cut</option>
                                        <option value="fa fa-cutlery"data-icon="fa fa-cutlery"> fa-cutlery</option>
                                        <option value="fa fa-dashboard"data-icon="fa fa-dashboard"> fa-dashboard</option>
                                        <option value="fa fa-dashcube"data-icon="fa fa-dashcube"> fa-dashcube</option>
                                        <option value="fa fa-database"data-icon="fa fa-database"> fa-database</option>
                                        <option value="fa fa fa-dedent"data-icon="fa fa fa-dedent"> fa-dedent</option>
                                        <option value="fa fa-delicious"data-icon="fa fa-delicious"> fa-delicious</option>
                                        <option value="fa fa-desktop"data-icon="fa fa-desktop"> fa-desktop</option>
                                        <option value="fa fa-deviantart"data-icon="fa fa-deviantart"> fa-deviantart</option>
                                        <option value="fa fa-diamond"data-icon="fa fa-diamond"> fa-diamond</option>
                                        <option value="fa fa-digg"data-icon="fa fa-digg"> fa-digg</option>
                                        <option value="fa fa-dollar"data-icon="fa fa-dollar"> fa-dollar</option>
                                        <option value="fa fa-download"data-icon="fa fa-download"> fa-download</option>
                                        <option value="fa fa-dribbble"data-icon="fa fa-dribbble"> fa-dribbble</option>
                                        <option value="fa fa-dropbox"data-icon="fa fa-dropbox"> fa-dropbox</option>
                                        <option value="fa fa-drupal"data-icon="fa fa-drupal"> fa-drupal</option>
                                        <option value="fa fa-edit"data-icon="fa fa-edit"> fa-edit</option>
                                        <option value="fa fa-eject"data-icon="fa fa-eject"> fa-eject</option>
                                        <option value="fa fa-ellipsis-h"data-icon="fa fa-ellipsis-h"> fa-ellipsis-h</option>
                                        <option value="fa fa-ellipsis-v"data-icon="fa fa-ellipsis-v"> fa-ellipsis-v</option>
                                        <option value="fa fa-empire"data-icon="fa fa-empire"> fa-empire</option>
                                        <option value="fa fa-envelope"data-icon="fa fa-envelope"> fa-envelope</option>
                                        <option value="fa fa-envelope-o"data-icon="fa fa-envelope-o"> fa-envelope-o</option>
                                        <option value="fa fa-eur"data-icon="fa fa-eur"> fa-eur</option>
                                        <option value="fa fa-euro"data-icon="fa fa-euro"> fa-euro</option>
                                        <option value="fa fa-exchange"data-icon="fa fa-exchange"> fa-exchange</option>
                                        <option value="fa fa-exclamation"data-icon="fa fa-exclamation"> fa-exclamation</option>
                                        <option value="fa fa-exclamation-circle"data-icon="fa fa-exclamation-circle"> fa-exclamation-circle</option>
                                        <option value="fa fa-exclamation-triangle"data-icon="fa fa-exclamation-triangle"> fa-exclamation-triangle</option>
                                        <option value="fa fa-expand"data-icon="fa fa-expand"> fa-expand</option>
                                        <option value="fa fa-expeditedssl"data-icon="fa fa-expeditedssl"> fa-expeditedssl</option>
                                        <option value="fa fa-external-link"data-icon="fa fa-external-link"> fa-external-link</option>
                                        <option value="fa fa-external-link-square"data-icon="fa fa-external-link-square"> fa-external-link-square</option>
                                        <option value="fa fa-eye"data-icon="fa fa-eye"> fa-eye</option>
                                        <option value="fa fa-eye-slash"data-icon="fa fa-eye-slash"> fa-eye-slash</option>
                                        <option value="fa fa-eyedropper"data-icon="fa fa-eyedropper"> fa-eyedropper</option>
                                        <option value="fa fa-facebook"data-icon="fa fa-facebook"> fa-facebook</option>
                                        <option value="fa fa-facebook-f"data-icon="fa fa-facebook-f"> fa-facebook-f</option>
                                        <option value="fa fa-facebook-official"data-icon="fa fa-facebook-official"> fa-facebook-official</option>
                                        <option value="fa fa-facebook-square"data-icon="fa fa-facebook-square"> fa-facebook-square</option>
                                        <option value="fa fa-fast-backward"data-icon="fa fa-fast-backward"> fa-fast-backward</option>
                                        <option value="fa fa-fast-forward"data-icon="fa fa-fast-forward"> fa-fast-forward</option>
                                        <option value="fa fa-fax"data-icon="fa fa-fax"> fa-fax</option>
                                        <option value="fa fa-feed"data-icon="fa fa-feed"> fa-feed</option>
                                        <option value="fa fa-female"data-icon="fa fa-female"> fa-female</option>
                                        <option value="fa fa-fighter-jet"data-icon="fa fa-fighter-jet"> fa-fighter-jet</option>
                                        <option value="fa fa-file"data-icon="fa fa-file"> fa-file</option>
                                        <option value="fa fa-file-archive-o"data-icon="fa fa-file-archive-o"> fa-file-archive-o</option>
                                        <option value="fa fa-file-audio-o"data-icon="fa fa-file-audio-o"> fa-file-audio-o</option>
                                        <option value="fa fa-file-code-o"data-icon="fa fa-file-code-o"> fa-file-code-o</option>
                                        <option value="fa fa-file-excel-o"data-icon="fa fa-file-excel-o"> fa-file-excel-o</option>
                                        <option value="fa fa-file-image-o"data-icon="fa fa-file-image-o"> fa-file-image-o</option>
                                        <option value="fa fa-file-movie-o"data-icon="fa fa-file-movie-o"> fa-file-movie-o</option>
                                        <option value="fa fa-file-o"data-icon="fa fa-file-o"> fa-file-o</option>
                                        <option value="fa fa-file-pdf-o"data-icon="fa fa-file-pdf-o"> fa-file-pdf-o</option>
                                        <option value="fa fa-file-photo-o"data-icon="fa fa-file-photo-o"> fa-file-photo-o</option>
                                        <option value="fa fa-file-picture-o"data-icon="fa fa-file-picture-o"> fa-file-picture-o</option>
                                        <option value="fa fa-file-powerpoint-o"data-icon="fa fa-file-powerpoint-o"> fa-file-powerpoint-o</option>
                                        <option value="fa fa-file-sound-o"data-icon="fa fa-file-sound-o"> fa-file-sound-o</option>
                                        <option value="fa fa-file-text"data-icon="fa fa-file-text"> fa-file-text</option>
                                        <option value="fa fa-file-text-o"data-icon="fa fa-file-text-o"> fa-file-text-o</option>
                                        <option value="fa fa-file-video-o"data-icon="fa fa-file-video-o"> fa-file-video-o</option>
                                        <option value="fa fa-file-word-o"data-icon="fa fa-file-word-o"> fa-file-word-o</option>
                                        <option value="fa fa-file-zip-o"data-icon="fa fa-file-zip-o"> fa-file-zip-o</option>
                                        <option value="fa fa-files-o"data-icon="fa fa-files-o"> fa-files-o</option>
                                        <option value="fa fa-film"data-icon="fa fa-film"> fa-film</option>
                                        <option value="fa fa-filter"data-icon="fa fa-filter"> fa-filter</option>
                                        <option value="fa fa-fire"data-icon="fa fa-fire"> fa-fire</option>
                                        <option value="fa fa-fire-extinguisher"data-icon="fa fa-fire-extinguisher"> fa-fire-extinguisher</option>
                                        <option value="fa fa-firefox"data-icon="fa fa-firefox"> fa-firefox</option>
                                        <option value="fa fa-flag"data-icon="fa fa-flag"> fa-flag</option>
                                        <option value="fa fa-flag-checkered"data-icon="fa fa-flag-checkered"> fa-flag-checkered</option>
                                        <option value="fa fa-flag-o"data-icon="fa fa-flag-o"> fa-flag-o</option>
                                        <option value="fa fa-flash"data-icon="fa fa-flash"> fa-flash</option>
                                        <option value="fa fa-flask"data-icon="fa fa-flask"> fa-flask</option>
                                        <option value="fa fa-flickr"data-icon="fa fa-flickr"> fa-flickr</option>
                                        <option value="fa fa-floppy-o"data-icon="fa fa-floppy-o"> fa-floppy-o</option>
                                        <option value="fa fa-folder"data-icon="fa fa-folder"> fa-folder</option>
                                        <option value="fa fa-folder-o"data-icon="fa fa-folder-o"> fa-folder-o</option>
                                        <option value="fa fa-folder-open"data-icon="fa fa-folder-open"> fa-folder-open</option>
                                        <option value="fa fa-folder-open-o"data-icon="fa fa-folder-open-o"> fa-folder-open-o</option>
                                        <option value="fa fa-font"data-icon="fa fa-font"> fa-font</option>
                                        <option value="fa fa-fonticons"data-icon="fa fa-fonticons"> fa-fonticons</option>
                                        <option value="fa fa-forumbee"data-icon="fa fa-forumbee"> fa-forumbee</option>
                                        <option value="fa fa-forward"data-icon="fa fa-forward"> fa-forward</option>
                                        <option value="fa fa-foursquare"data-icon="fa fa-foursquare"> fa-foursquare</option>
                                        <option value="fa fa-frown-o"data-icon="fa fa-frown-o"> fa-frown-o</option>
                                        <option value="fa fa-futbol-o"data-icon="fa fa-futbol-o"> fa-futbol-o</option>
                                        <option value="fa fa-gamepad"data-icon="fa fa-gamepad"> fa-gamepad</option>
                                        <option value="fa fa-gavel"data-icon="fa fa-gavel"> fa-gavel</option>
                                        <option value="fa fa-gbp"data-icon="fa fa-gbp"> fa-gbp</option>
                                        <option value="fa fa-ge"data-icon="fa fa-ge"> fa-ge</option>
                                        <option value="fa fa-gear"data-icon="fa fa-gear"> fa-gear</option>
                                        <option value="fa fa-gears"data-icon="fa fa-gears"> fa-gears</option>
                                        <option value="fa fa-genderless"data-icon="fa fa-genderless"> fa-genderless</option>
                                        <option value="fa fa-get-pocket"data-icon="fa fa-get-pocket"> fa-get-pocket</option>
                                        <option value="fa fa-gg"data-icon="fa fa-gg"> fa-gg</option>
                                        <option value="fa fa-gg-circle"data-icon="fa fa-gg-circle"> fa-gg-circle</option>
                                        <option value="fa fa-gift"data-icon="fa fa-gift"> fa-gift</option>
                                        <option value="fa fa-git"data-icon="fa fa-git"> fa-git</option>
                                        <option value="fa fa-git-square"data-icon="fa fa-git-square"> fa-git-square</option>
                                        <option value="fa fa-github"data-icon="fa fa-github"> fa-github</option>
                                        <option value="fa fa-github-alt"data-icon="fa fa-github-alt"> fa-github-alt</option>
                                        <option value="fa fa-github-square"data-icon="fa fa-github-square"> fa-github-square</option>
                                        <option value="fa fa-gittip"data-icon="fa fa-gittip"> fa-gittip</option>
                                        <option value="fa fa-glass"data-icon="fa fa-glass"> fa-glass</option>
                                        <option value="fa fa-globe"data-icon="fa fa-globe"> fa-globe</option>
                                        <option value="fa fa-google"data-icon="fa fa-google"> fa-google</option>
                                        <option value="fa fa-google-plus"data-icon="fa fa-google-plus"> fa-google-plus</option>
                                        <option value="fa fa-google-plus-square"data-icon="fa fa-google-plus-square"> fa-google-plus-square</option>
                                        <option value="fa fa-google-wallet"data-icon="fa fa-google-wallet"> fa-google-wallet</option>
                                        <option value="fa fa-graduation-cap"data-icon="fa fa-graduation-cap"> fa-graduation-cap</option>
                                        <option value="fa fa-gratipay"data-icon="fa fa-gratipay"> fa-gratipay</option>
                                        <option value="fa fa-group"data-icon="fa fa-group"> fa-group</option>
                                        <option value="fa fa-h-square"data-icon="fa fa-h-square"> fa-h-square</option>
                                        <option value="fa fa-hacker-news"data-icon="fa fa-hacker-news"> fa-hacker-news</option>
                                        <option value="fa fa-hand-grab-o"data-icon="fa fa-hand-grab-o"> fa-hand-grab-o</option>
                                        <option value="fa fa-hand-lizard-o"data-icon="fa fa-hand-lizard-o"> fa-hand-lizard-o</option>
                                        <option value="fa fa-hand-o-down"data-icon="fa fa-hand-o-down"> fa-hand-o-down</option>
                                        <option value="fa fa-hand-o-left"data-icon="fa fa-hand-o-left"> fa-hand-o-left</option>
                                        <option value="fa fa-hand-o-right"data-icon="fa fa-hand-o-right"> fa-hand-o-right</option>
                                        <option value="fa fa-hand-o-up"data-icon="fa fa-hand-o-up"> fa-hand-o-up</option>
                                        <option value="fa fa-hand-paper-o"data-icon="fa fa-hand-paper-o"> fa-hand-paper-o</option>
                                        <option value="fa fa-hand-peace-o"data-icon="fa fa-hand-peace-o"> fa-hand-peace-o</option>
                                        <option value="fa fa-hand-pointer-o"data-icon="fa fa-hand-pointer-o"> fa-hand-pointer-o</option>
                                        <option value="fa fa-hand-rock-o"data-icon="fa fa-hand-rock-o"> fa-hand-rock-o</option>
                                        <option value="fa fa-hand-scissors-o"data-icon="fa fa-hand-scissors-o"> fa-hand-scissors-o</option>
                                        <option value="fa fa-hand-spock-o"data-icon="fa fa-hand-spock-o"> fa-hand-spock-o</option>
                                        <option value="fa fa-hand-stop-o"data-icon="fa fa-hand-stop-o"> fa-hand-stop-o</option>
                                        <option value="fa fa-hdd-o"data-icon="fa fa-hdd-o"> fa-hdd-o</option>
                                        <option value="fa fa-header"data-icon="fa fa-header"> fa-header</option>
                                        <option value="fa fa-headphones"data-icon="fa fa-headphones"> fa-headphones</option>
                                        <option value="fa fa-heart"data-icon="fa fa-heart"> fa-heart</option>
                                        <option value="fa fa-heart-o"data-icon="fa fa-heart-o"> fa-heart-o</option>
                                        <option value="fa fa-heartbeat"data-icon="fa fa-heartbeat"> fa-heartbeat</option>
                                        <option value="fa fa-history"data-icon="fa fa-history"> fa-history</option>
                                        <option value="fa fa-home"data-icon="fa fa-home"> fa-home</option>
                                        <option value="fa fa-hospital-o"data-icon="fa fa-hospital-o"> fa-hospital-o</option>
                                        <option value="fa fa-hotel"data-icon="fa fa-hotel"> fa-hotel</option>
                                        <option value="fa fa-hourglass"data-icon="fa fa-hourglass"> fa-hourglass</option>
                                        <option value="fa fa-hourglass-1"data-icon="fa fa-hourglass-1"> fa-hourglass-1</option>
                                        <option value="fa fa-hourglass-2"data-icon="fa fa-hourglass-2"> fa-hourglass-2</option>
                                        <option value="fa fa-hourglass-3"data-icon="fa fa-hourglass-3"> fa-hourglass-3</option>
                                        <option value="fa fa-hourglass-end"data-icon="fa fa-hourglass-end"> fa-hourglass-end</option>
                                        <option value="fa fa-hourglass-half"data-icon="fa fa-hourglass-half"> fa-hourglass-half</option>
                                        <option value="fa fa-hourglass-o"data-icon="fa fa-hourglass-o"> fa-hourglass-o</option>
                                        <option value="fa fa-hourglass-start"data-icon="fa fa-hourglass-start"> fa-hourglass-start</option>
                                        <option value="fa fa-houzz"data-icon="fa fa-houzz"> fa-houzz</option>
                                        <option value="fa fa-html5"data-icon="fa fa-html5"> fa-html5</option>
                                        <option value="fa fa-i-cursor"data-icon="fa fa-i-cursor"> fa-i-cursor</option>
                                        <option value="fa fa-ils"data-icon="fa fa-ils"> fa-ils</option>
                                        <option value="fa fa-image"data-icon="fa fa-image"> fa-image</option>
                                        <option value="fa fa-inbox"data-icon="fa fa-inbox"> fa-inbox</option>
                                        <option value="fa fa-indent"data-icon="fa fa-indent"> fa-indent</option>
                                        <option value="fa fa-industry"data-icon="fa fa-industry"> fa-industry</option>
                                        <option value="fa fa-info"data-icon="fa fa-info"> fa-info</option>
                                        <option value="fa fa-info-circle"data-icon="fa fa-info-circle"> fa-info-circle</option>
                                        <option value="fa fa-inr"data-icon="fa fa-inr"> fa-inr</option>
                                        <option value="fa fa-instagram"data-icon="fa fa-instagram"> fa-instagram</option>
                                        <option value="fa fa-institution"data-icon="fa fa-institution"> fa-institution</option>
                                        <option value="fa fa-internet-explorer"data-icon="fa fa-internet-explorer"> fa-internet-explorer</option>
                                        <option value="fa fa-intersex"data-icon="fa fa-intersex"> fa-intersex</option>
                                        <option value="fa fa-ioxhost"data-icon="fa fa-ioxhost"> fa-ioxhost</option>
                                        <option value="fa fa-italic"data-icon="fa fa-italic"> fa-italic</option>
                                        <option value="fa fa-joomla"data-icon="fa fa-joomla"> fa-joomla</option>
                                        <option value="fa fa-jpy"data-icon="fa fa-jpy"> fa-jpy</option>
                                        <option value="fa fa-jsfiddle"data-icon="fa fa-jsfiddle"> fa-jsfiddle</option>
                                        <option value="fa fa-key"data-icon="fa fa-key"> fa-key</option>
                                        <option value="fa fa-keyboard-o"data-icon="fa fa-keyboard-o"> fa-keyboard-o</option>
                                        <option value="fa fa-krw"data-icon="fa fa-krw"> fa-krw</option>
                                        <option value="fa fa-language"data-icon="fa fa-language"> fa-language</option>
                                        <option value="fa fa-laptop"data-icon="fa fa-laptop"> fa-laptop</option>
                                        <option value="fa fa-lastfm"data-icon="fa fa-lastfm"> fa-lastfm</option>
                                        <option value="fa fa-lastfm-square"data-icon="fa fa-lastfm-square"> fa-lastfm-square</option>
                                        <option value="fa fa-leaf"data-icon="fa fa-leaf"> fa-leaf</option>
                                        <option value="fa fa-leanpub"data-icon="fa fa-leanpub"> fa-leanpub</option>
                                        <option value="fa fa-legal"data-icon="fa fa-legal"> fa-legal</option>
                                        <option value="fa fa-lemon-o"data-icon="fa fa-lemon-o"> fa-lemon-o</option>
                                        <option value="fa fa-level-down"data-icon="fa fa-level-down"> fa-level-down</option>
                                        <option value="fa fa-level-up"data-icon="fa fa-level-up"> fa-level-up</option>
                                        <option value="fa fa-life-bouy"data-icon="fa fa-life-bouy"> fa-life-bouy</option>
                                        <option value="fa fa-life-buoy"data-icon="fa fa-life-buoy"> fa-life-buoy</option>
                                        <option value="fa fa-life-ring"data-icon="fa fa-life-ring"> fa-life-ring</option>
                                        <option value="fa fa-life-saver"data-icon="fa fa-life-saver"> fa-life-saver</option>
                                        <option value="fa fa-lightbulb-o"data-icon="fa fa-lightbulb-o"> fa-lightbulb-o</option>
                                        <option value="fa fa-line-chart"data-icon="fa fa-line-chart"> fa-line-chart</option>
                                        <option value="fa fa-link"data-icon="fa fa-link"> fa-link</option>
                                        <option value="fa fa-linkedin"data-icon="fa fa-linkedin"> fa-linkedin</option>
                                        <option value="fa fa-linkedin-square"data-icon="fa fa-linkedin-square"> fa-linkedin-square</option>
                                        <option value="fa fa-linux"data-icon="fa fa-linux"> fa-linux</option>
                                        <option value="fa fa-list"data-icon="fa fa-list"> fa-list</option>
                                        <option value="fa fa-list-alt"data-icon="fa fa-list-alt"> fa-list-alt</option>
                                        <option value="fa fa-list-ol"data-icon="fa fa-list-ol"> fa-list-ol</option>
                                        <option value="fa fa-list-ul"data-icon="fa fa-list-ul"> fa-list-ul</option>
                                        <option value="fa fa-location-arrow"data-icon="fa fa-location-arrow"> fa-location-arrow</option>
                                        <option value="fa fa-lock"data-icon="fa fa-lock"> fa-lock</option>
                                        <option value="fa fa-long-arrow-down"data-icon="fa fa-long-arrow-down"> fa-long-arrow-down</option>
                                        <option value="fa fa-long-arrow-left"data-icon="fa fa-long-arrow-left"> fa-long-arrow-left</option>
                                        <option value="fa fa-long-arrow-right"data-icon="fa fa-long-arrow-right"> fa-long-arrow-right</option>
                                        <option value="fa fa-long-arrow-up"data-icon="fa fa-long-arrow-up"> fa-long-arrow-up</option>
                                        <option value="fa fa-magic"data-icon="fa fa-magic"> fa-magic</option>
                                        <option value="fa fa-magnet"data-icon="fa fa-magnet"> fa-magnet</option>

                                        <option value="fa fa-mars-stroke-v"data-icon="fa fa-mars-stroke-v"> fa-mars-stroke-v</option>
                                        <option value="fa fa-maxcdn"data-icon="fa fa-maxcdn"> fa-maxcdn</option>
                                        <option value="fa fa-meanpath"data-icon="fa fa-meanpath"> fa-meanpath</option>
                                        <option value="fa fa-medium"data-icon="fa fa-medium"> fa-medium</option>
                                        <option value="fa fa-medkit"data-icon="fa fa-medkit"> fa-medkit</option>
                                        <option value="fa fa-meh-o"data-icon="fa fa-meh-o"> fa-meh-o</option>
                                        <option value="fa fa-mercury"data-icon="fa fa-mercury"> fa-mercury</option>
                                        <option value="fa fa-microphone"data-icon="fa fa-microphone"> fa-microphone</option>
                                        <option value="fa fa-mobile"data-icon="fa fa-mobile"> fa-mobile</option>
                                        <option value="fa fa-motorcycle"data-icon="fa fa-motorcycle"> fa-motorcycle</option>
                                        <option value="fa fa-mouse-pointer"data-icon="fa fa-mouse-pointer"> fa-mouse-pointer</option>
                                        <option value="fa fa-music"data-icon="fa fa-music"> fa-music</option>
                                        <option value="fa fa-navicon"data-icon="fa fa-navicon"> fa-navicon</option>
                                        <option value="fa fa-neuter"data-icon="fa fa-neuter"> fa-neuter</option>
                                        <option value="fa fa-newspaper-o"data-icon="fa fa-newspaper-o"> fa-newspaper-o</option>
                                        <option value="fa fa-opencart"data-icon="fa fa-opencart"> fa-opencart</option>
                                        <option value="fa fa-openid"data-icon="fa fa-openid"> fa-openid</option>
                                        <option value="fa fa-opera"data-icon="fa fa-opera"> fa-opera</option>
                                        <option value="fa fa-outdent"data-icon="fa fa-outdent"> fa-outdent</option>
                                        <option value="fa fa-pagelines"data-icon="fa fa-pagelines"> fa-pagelines</option>
                                        <option value="fa fa-paper-plane-o"data-icon="fa fa-paper-plane-o"> fa-paper-plane-o</option>
                                        <option value="fa fa-paperclip"data-icon="fa fa-paperclip"> fa-paperclip</option>
                                        <option value="fa fa-paragraph"data-icon="fa fa-paragraph"> fa-paragraph</option>
                                        <option value="fa fa-paste"data-icon="fa fa-paste"> fa-paste</option>
                                        <option value="fa fa-pause"data-icon="fa fa-pause"> fa-pause</option>
                                        <option value="fa fa-paw"data-icon="fa fa-paw"> fa-paw</option>
                                        <option value="fa fa-paypal"data-icon="fa fa-paypal"> fa-paypal</option>
                                        <option value="fa fa-pencil"data-icon="fa fa-pencil"> fa-pencil</option>
                                        <option value="fa fa-pencil-square-o"data-icon="fa fa-pencil-square-o"> fa-pencil-square-o</option>
                                        <option value="fa fa-phone"data-icon="fa fa-phone"> fa-phone</option>
                                        <option value="fa fa-photo"data-icon="fa fa-photo"> fa-photo</option>
                                        <option value="fa fa-picture-o"data-icon="fa fa-picture-o"> fa-picture-o</option>
                                        <option value="fa fa-pie-chart"data-icon="fa fa-pie-chart"> fa-pie-chart</option>
                                        <option value="fa fa-pied-piper"data-icon="fa fa-pied-piper"> fa-pied-piper</option>
                                        <option value="fa fa-pied-piper-alt"data-icon="fa fa-pied-piper-alt"> fa-pied-piper-alt</option>
                                        <option value="fa fa-pinterest"data-icon="fa fa-pinterest"> fa-pinterest</option>
                                        <option value="fa fa-pinterest-p"data-icon="fa fa-pinterest-p"> fa-pinterest-p</option>
                                        <option value="fa fa-pinterest-square"data-icon="fa fa-pinterest-square"> fa-pinterest-square</option>
                                        <option value="fa fa-plane"data-icon="fa fa-plane"> fa-plane</option>
                                        <option value="fa fa-play"data-icon="fa fa-play"> fa-play</option>
                                        <option value="fa fa-play-circle"data-icon="fa fa-play-circle"> fa-play-circle</option>
                                        <option value="fa fa-play-circle-o"data-icon="fa fa-play-circle-o"> fa-play-circle-o</option>
                                        <option value="fa fa-plug"data-icon="fa fa-plug"> fa-plug</option>
                                        <option value="fa fa-plus"data-icon="fa fa-plus"> fa-plus</option>
                                        <option value="fa fa-plus-circle"data-icon="fa fa-plus-circle"> fa-plus-circle</option>
                                        <option value="fa fa-plus-square"data-icon="fa fa-plus-square"> fa-plus-square</option>
                                        <option value="fa fa-plus-square-o"data-icon="fa fa-plus-square-o"> fa-plus-square-o</option>
                                        <option value="fa fa-power-off"data-icon="fa fa-power-off"> fa-power-off</option>
                                        <option value="fa fa-print"data-icon="fa fa-print"> fa-print</option>
                                        <option value="fa fa-puzzle-piece"data-icon="fa fa-puzzle-piece"> fa-puzzle-piece</option>
                                        <option value="fa fa-qq"data-icon="fa fa-qq"> fa-qq</option>
                                        <option value="fa fa-qrcode"data-icon="fa fa-qrcode"> fa-qrcode</option>
                                        <option value="fa fa-question"data-icon="fa fa-question"> fa-question</option>
                                        <option value="fa fa-question-circle"data-icon="fa fa-question-circle"> fa-question-circle</option>
                                        <option value="fa fa-quote-left"data-icon="fa fa-quote-left"> fa-quote-left</option>
                                        <option value="fa fa-quote-right"data-icon="fa fa-quote-right"> fa-quote-right</option>
                                        <option value="fa fa-ra"data-icon="fa fa-ra"> fa-ra</option>
                                        <option value="fa fa-random"data-icon="fa fa-random"> fa-random</option>
                                        <option value="fa fa-rebel"data-icon="fa fa-rebel"> fa-rebel</option>
                                        <option value="fa fa-recycle"data-icon="fa fa-recycle"> fa-recycle</option>
                                        <option value="fa fa-reddit"data-icon="fa fa-reddit"> fa-reddit</option>
                                        <option value="fa fa-reddit-square"data-icon="fa fa-reddit-square"> fa-reddit-square</option>
                                        <option value="fa fa-refresh"data-icon="fa fa-refresh"> fa-refresh</option>
                                        <option value="fa fa-registered"data-icon="fa fa-registered"> fa-registered</option>
                                        <option value="fa fa-remove"data-icon="fa fa-remove"> fa-remove</option>
                                        <option value="fa fa-renren"data-icon="fa fa-renren"> fa-renren</option>
                                        <option value="fa fa-reorder"data-icon="fa fa-reorder"> fa-reorder</option>
                                        <option value="fa fa-repeat"data-icon="fa fa-repeat"> fa-repeat</option>
                                        <option value="fa fa-reply"data-icon="fa fa-reply"> fa-reply</option>
                                        <option value="fa fa-reply-all"data-icon="fa fa-reply-all"> fa-reply-all</option>
                                        <option value="fa fa-retweet"data-icon="fa fa-retweet"> fa-retweet</option>
                                        <option value="fa fa-rmb"data-icon="fa fa-rmb"> fa-rmb</option>
                                        <option value="fa fa-road"data-icon="fa fa-road"> fa-road</option>
                                        <option value="fa fa-rocket"data-icon="fa fa-rocket"> fa-rocket</option>
                                        <option value="fa fa-rotate-left"data-icon="fa fa-rotate-left"> fa-rotate-left</option>
                                        <option value="fa fa-rotate-right"data-icon="fa fa-rotate-right"> fa-rotate-right</option>
                                        <option value="fa fa-rouble"data-icon="fa fa-rouble"> fa-rouble</option>
                                        <option value="fa fa-rss"data-icon="fa fa-rss"> fa-rss</option>
                                        <option value="fa fa-rss-square"data-icon="fa fa-rss-square"> fa-rss-square</option>
                                        <option value="fa fa-rub"data-icon="fa fa-rub"> fa-rub</option>
                                        <option value="fa fa-ruble"data-icon="fa fa-ruble"> fa-ruble</option>
                                        <option value="fa fa-rupee"data-icon="fa fa-rupee"> fa-rupee</option>
                                        <option value="fa fa-safari"data-icon="fa fa-safari"> fa-safari</option>
                                        <option value="fa fa-sliders"data-icon="fa fa-sliders"> fa-sliders</option>
                                        <option value="fa fa-slideshare"data-icon="fa fa-slideshare"> fa-slideshare</option>
                                        <option value="fa fa-smile-o"data-icon="fa fa-smile-o"> fa-smile-o</option>
                                        <option value="fa fa-sort-asc"data-icon="fa fa-sort-asc"> fa-sort-asc</option>
                                        <option value="fa fa-sort-desc"data-icon="fa fa-sort-desc"> fa-sort-desc</option>
                                        <option value="fa fa-sort-down"data-icon="fa fa-sort-down"> fa-sort-down</option>
                                        <option value="fa fa-spinner"data-icon="fa fa-spinner"> fa-spinner</option>
                                        <option value="fa fa-spoon"data-icon="fa fa-spoon"> fa-spoon</option>
                                        <option value="fa fa-spotify"data-icon="fa fa-spotify"> fa-spotify</option>
                                        <option value="fa fa-square"data-icon="fa fa-square"> fa-square</option>
                                        <option value="fa fa-square-o"data-icon="fa fa-square-o"> fa-square-o</option>
                                        <option value="fa fa-star"data-icon="fa fa-star"> fa-star</option>
                                        <option value="fa fa-star-half" data-icon="fa fa-star-half"> fa-star-half</option>
                                        <option value="fa fa-stop"data-icon="fa fa-stop"> fa-stop</option>
                                        <option value="fa fa-subscript"data-icon="fa fa-subscript"> fa-subscript</option>
                                        <option value="fa fa-tablet"data-icon="fa fa-tablet"> fa-tablet</option>
                                        <option value="fa fa-tachometer"data-icon="fa fa-tachometer"> fa-tachometer</option>
                                        <option value="fa fa-tag"data-icon="fa fa-tag"> fa-tag</option>
                                        <option value="fa fa-tags"data-icon="fa fa-tags"> fa-tags</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">insert_emoticon</i>
                                </span>
                                <div>
                                    <select id="cat_s" name="cat_s"  data-live-search="true">
                                        <option value="NULL">*Seleccione Categoria*</option>
                                        <?php foreach ($categorias as $c) { ?>
                                            <option value="<?php echo $c["id_cat_noticia"]; ?>" data-icon="<?php echo $c["nc_icono"]; ?>">
                                                <?php echo $c["nc_noticia"]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">public</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control date" placeholder="Url" id="url" name="url">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="updateId" name="updateId">
                    <input type="hidden"  name="action" id="action" value="create">
                    </div>
                    <div class="modal-footer">
                        <button class="btn bg-<?php echo $tema; ?> waves-effect" type="submit"  name="submit" id="submit"  ><b id="nombreb"></b>
                        </button>
                        </form>
                <button class="btn btn-link waves-effect" data-dismiss="modal" type="button">
                    Cancelar
                </button>
            </div>
        </div>

<script src="<?php echo base_url(); ?>assets/select2/js/select2.js"></script>                    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main_js/categoria.js"></script>


