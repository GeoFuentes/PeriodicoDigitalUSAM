<?php setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish'); ?>
<!------------------------------------------------------------- Carrousel -------------------------------------------------------------->
<div id="slider" class="section main_slider">
  <div class="container-fuild">
    <div class="row">
      <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
        <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
          <ul>
            <?php foreach ($carrousel as $c) { ?>
              <li data-index="rs-<?php echo $c['idcarrousel']; ?>" data-transition="zoomin" data-slotamount="7" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="<?php echo base_url() ?>assets/upload/carrousel/<?php echo $c['foto']; ?>" data-rotate="0" data-saveperformance="off" data-title="<?php echo $c['titulo']; ?>" data-description="">
                <img src="<?php echo base_url() ?>assets/upload/carrousel/<?php echo $c['foto']; ?>" alt="#" data-bgposition="center center" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                <div class="tp-caption tp-shape tp-shapewrapper   tp-resizeme rs-parallaxlevel-0" id="slide-18-layer-912" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['15','15','15','15']" data-width="500" data-height="140" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="2000" data-responsive_offset="on" style="z-index: 5;background-color:rgba(29, 29, 29, 0.85);border-color:rgba(0, 0, 0, 0.50);"> </div>
                <div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0" id="slide-18-layer-112" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontsize="['70','70','70','35']" data-lineheight="['70','70','70','50']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="z-index: 6; white-space: nowrap;"><a href="<?php echo $c['url']; ?>" style="color:white;"><?php echo $c['titulo']; ?></a></div>                
                <!-- <div class="tp-caption NotGeneric-SubTitle   tp-resizeme rs-parallaxlevel-0" id="slide-18-layer-412" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','51','51','31']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;">Available On It.Next </div> -->
              </li>
            <?php } ?>
          </ul>
          <div class="tp-static-layers"></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="section padding_layout_1">
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="full">
              <div class="main_heading text_align_center">
                <?php foreach ($last_ed as $l) { ?>
                  <h2>Edicion N° <?php echo $l['num_edicion']; ?></h2>
                <?php } ?>
              </div>

              <?php foreach ($noticias as $n) { ?>
                <div class="blog_section">
                  <div class="blog_feature_img"> <img class="img-responsive" src="<?php echo base_url() ?>assets/upload/noticias/<?php echo $n['url']; ?>" alt="#"> </div>
                  <div class="blog_feature_cantant">
                    <p class="blog_head"><?php echo $n['Titular']; ?></p>
                    <div class="post_info">
                      <ul>
                        <li><i class="<?php echo $n['nc_icono']; ?>" aria-hidden="true"></i> <?php echo $n['nc_noticia']; ?></li>
                        <!-- <li><i class="fa fa-comment" aria-hidden="true"></i> 5</li> -->
                        <li><i class="fa fa-user" aria-hidden="true"></i> <?php echo $n['Editor']; ?></li>
                        <li><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $n['Reportero']; ?></li>
                        <li><i class="fa fa-camera" aria-hidden="true"></i> <?php echo $n['Fotografo']; ?></li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $n['Fecha']; ?></li>
                      </ul>
                    </div>
                    <p><?php echo $n['Nota']; ?> .....</p>
                    <div class="bottom_info">
                      <div class="pull-left"><a class="btn sqaure_bt" id="btnNoticia" data-btnNoticiaId="<?php echo $n['id_noticia']; ?>" href="">Leer Mas<i class="fa fa-angle-right"></i></a></div>
                      <div class="pull-right">
                        <div class="shr">Compartir: </div>
                        <div class="social_icon">
                          <ul>
                            <li class="fb"><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li class="fb"><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li class="twi">
                              <a id="shareBtn" data-title="<?php echo $n['Titular']; ?>" data-img="<?php echo base_url() ?>assets/upload/noticias/<?php echo $n['url']; ?>" target="_blank" href="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="main_heading text_align_center">
              <h2>Ultimas Ediciones</h2>
            </div>
          </div>
          <?php foreach ($ediciones as $e) { ?>
            <div class="col-md-4">
              <h3 style="color:;">Edicion N° <?php echo $e['num_edicion']; ?></h3>
              <div class="full blog_colum">
                <div class="blog_feature_img"> <img src="<?php echo base_url() ?>assets/upload/noticias/<?php echo $e['url']; ?>" alt="#" /> </div>
                <div class="post_time">
                  <p><i class="fa fa-clock-o"></i> <?php echo strftime("%A, %d de %B de %Y", strtotime($e['Fecha'])); ?></p>
                </div>
                <div class="blog_feature_head">
                  <h4><a id="btnNoticia" data-btnNoticiaId="<?php echo $e['id_noticia']; ?>" href=""><?php echo $e['Titular']; ?></a></h4>
                </div>
                <div class="blog_feature_cont">
                  <p><?php echo $e['Nota']; ?> ...</p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
