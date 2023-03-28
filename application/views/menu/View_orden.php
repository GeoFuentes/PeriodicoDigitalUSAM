 <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Definir el orden de los modulos
                            </h2>
                        </div>
                        <div class="body">
                            <div class="clearfix m-b-20">
                                <div class="dd nestable-with-handle" >
                                    <ol class="dd-list" >
                                        <?php foreach ($a as $key => $value): ?>
                                           <li  class="dd-item dd3-item" data-item="<?php echo $value->id_menu ?>" >
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content" style="color:<?php echo $tema ?>"><?php echo $value->menu; ?></div>
                                        </li> 
                                        <?php endforeach ?>
                                        
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Draggable Handles -->
        </div>


        
    </section>

    <script>
        $(document).ready(function () {
    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target), output = list.data('output');

        $.ajax({
            method: "POST",
            url: host + "Controller_menu/save_orden_menu",
            data: {
                list: list.nestable('serialize')
            },
            success:function(){
                showNotification('bg-blue', 'El oden del menú se modifico con exito', 'top', 'right', 'animated bounceIn', 'animated bounceOut');
            }
        }).fail(function(jqXHR, textStatus, errorThrown){
            alert("Unable to save new list order: " + errorThrown);
        });
    };

    $('.dd').nestable({
        group: 1,
        maxDepth: 7,
    }).on('change', updateOutput);
});
    </script>