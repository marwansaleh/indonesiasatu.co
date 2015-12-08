<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="<?php echo site_url('assets/img/one.png'); ?>"/>
        <!-- Meta tags -->
        <title>Application Log</title>

        <!-- Bootstrap CSS -->    
        <link href="<?php echo site_url(config_item('path_lib').'bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="<?php echo site_url(config_item('path_lib').'bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo site_url(config_item('path_lib').'font-awesome-4.1.0/css/font-awesome.min.css'); ?>" rel="stylesheet" />    
      
        <!-- Custom styles -->
        <link href="<?php echo site_url(config_item('path_assets').'css/log.css'); ?>" rel="stylesheet">
        <script src="<?php echo site_url(config_item('path_lib').'jquery/jquery-1.11.2.min.js'); ?>"></script>
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
        <!--[if lt IE 9]>
          <script src="<?php echo site_url(config_item('path_lib').'html5shiv/html5shiv.min.js'); ?>"></script>
          <script src="<?php echo site_url(config_item('path_lib').'respondjs/respond.min.js'); ?>"></script>
          <script src="<?php echo site_url(config_item('path_lib').'lte-ie7/lte-ie7.js'); ?>"></script>
        <![endif]-->
        
    </head>
    <body>
        <div id="main" class="container-fluid">
            <h1 class="page-header">Log Environment: <?php echo strtoupper(ENVIRONMENT); ?></h1>
            
            <table class="table table-striped log-container">
                <thead>
                    <tr>
                        <th>Datetime</th>
                        <th>Cookie ID</th>
                        <th>IP Address</th>
                        <th>Event Description</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>>
        </div>
        
        <script type="text/javascript">
            var LogManager = {
                inProccess: false,
                numLine: 15,
                repeatSecs: 6000,
                init: function (){
                    
                },
                setLines: function (num){
                    this.numLine = parseInt(num); 
                },
                loadLines: function (){
                    var _this = this;
                    if (_this.inProccess){
                        return;
                    }
                    _this.inProccess = true;
                    
                    $.getJSON("<?php echo site_url('service/log/index'); ?>",{lines:_this.numLine},function(data){
                        
                        _this.inProccess = false;
                        
                        for (var i in data){
                            var s = '<tr>';
                                s+= '<td>'+data[i].datetime+'</td>'
                                s+= '<td>'+data[i].cookie_id+'</td>';
                                s+= '<td>'+data[i].ip_address+'</td>';
                                s+= '<td>'+data[i].event_description+'</td>';
                            s+='</tr>';
                            
                            $('#main table tbody').append(s);
                        }
                        
                        //repeat again loading logs
                        setTimeout(function (){
                            _this.loadLines();
                        }, _this.repeatSecs);
                    });
                },
            };
        </script>
        
        <!-- bootstrap -->
        <script src="<?php echo site_url(config_item('path_lib').'bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- nice scroll -->
        <script src="<?php echo site_url(config_item('path_lib').'scrollTo/jquery.scrollTo.min.js'); ?>"></script>
        <script src="<?php echo site_url(config_item('path_lib').'nicescroll/jquery.nicescroll.min.js'); ?>" type="text/javascript"></script>
    </body>
</html>