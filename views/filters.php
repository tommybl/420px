<section class="bg-primary" style="padding: 10px 0 10px 0!important; background-color: #555"><strong style="margin-left: 30px">Transformations</strong></section>
<section class="no-padding" id="transform">
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" >
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=annotate&text='.$user_session->username.'"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Annotate
                            </div>
                            <form action=<?php echo '"./dataAccess/apply-filter.php"'; ?> method="GET" style="padding: 10px">
                                <input type="hidden" class="form-control" name="img" value=<?php echo '"'.$image_get->id.'"'; ?> required>
                                <input type="hidden" class="form-control" name="filter" value="annotate" required>
                                <input type="text" class="form-control" name="text" placeholder="Enter some text" required>
                                <button type="submit" class="btn btn-default btn-md" style="margin-top: 5px">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=flip\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=flip"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Flip
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=flop\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=flop"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Flop
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=rotate-right\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=rotate-right"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Rotate right
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=rotate-left\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=rotate-left"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Rotate left
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=rotate-180\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=rotate-180"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Rotate 180
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=swrill\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=swrill"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Swrill
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=wave\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=wave"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Wave
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=multiply\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=multiply"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Multiply
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=vignette\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=vignette"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Vignette
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=shear\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=shear"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Shear
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=frame\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=frame"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Framed
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-primary" style="padding: 10px 0 10px 0!important; background-color: #555"><strong style="margin-left: 30px">Filters</strong></section>
<section class="no-padding" id="filters">
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=more-contrast\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=more-contrast"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                More contrast
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=less-contrast\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=less-contrast"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Less contrast
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=more-brightness\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=more-brightness"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                More brightness
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=less-brightness\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=less-brightness"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Less brightness
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=grayscale\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=grayscale"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Grayscale
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=sepia\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=sepia"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Sepia
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=gaussian\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=gaussian"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Gaussian
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=more-saturation\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=more-saturation"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                More saturation
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=less-saturation\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=less-saturation"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Less saturation
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=more-hue\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=more-hue"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                More hue
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=less-hue\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=less-hue"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Less hue
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=colored-paint\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=colored-paint"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Colored paint
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=more-noise\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=more-noise"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                More noise
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=less-noise\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=less-noise"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Less noise
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=dark-paint\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=dark-paint"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Dark paint
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=charcoal\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=charcoal"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Charcoal
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=colorize\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=colorize"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Random colorized
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=dark-edge\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=dark-edge"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Dark edge
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=bright-paint\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=bright-paint"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Bright paint
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=emboss\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=emboss"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Emboss
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=negate\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=negate"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Negate
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=oil-paint\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=oil-paint"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Oil paint
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=radial\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=radial"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Radial blur
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=shade\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=shade"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Shade
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=sketch\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=sketch"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Sketch
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=spread\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=spread"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Spread
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=black-white\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=black-white"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Black & white
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=solorize\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=solorize"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Solorize
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=segment\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=segment"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Segment
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <div class="portfolio-box" onClick=<?php echo '"window.location.href=\'./dataAccess/apply-filter.php?img='.$image_get->id.'&filter=adaptive\'"'; ?>>
                    <img src=<?php echo '"datas/images.php?img='.$image_get->id.'&filter=adaptive"'; ?> class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-name">
                                Adaptive
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>