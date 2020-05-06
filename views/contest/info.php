<?php

include "views/contest/info1.php";

return;
?>

<style type="text/css">
	.contestBanner{
		width: 100%;
		background: #000000;
		border-width: 3px;
		border-style: solid;
		border-color: #2C3542;
		margin-top: -22px;
	}
	.BannerTitle{
		background: #2C3542;
	  	text-align: center;
	  	font-size: 45px;
	  	color: #ffffff;
	  	text-shadow: 2px 2px 4px #E74C3C;
	  	width: 100%;
	  	font-family: "Trebuchet MS", Helvetica, sans-serif;
	  	padding: 5px 0px 5px 0px;
	  	position: relative;
	  	box-shadow: 0px 2px 30px 0px #404854;
	  	height: auto;
	}
	.BannerTime{
		background: #bdc3c7;
		font-size: 18px;
	}
	.animationBanner{
		background: #2C3542;
		height: 100px;
		width: 100%;
	}
	.contestBtn{
		text-align: center;
	}


</style>
<div class="row ">
	<div class="col-md-12">
		<div class="contestBanner">
      		<div id="particles-js" class="animationBanner"></div>
    	</div>
    	<div class="BannerTitle">Criterion 2020 Round 5</div>
	</div>

	<div class="col-md-8" style= "padding-right:0px">
		<div class="box_body" style="height: 300px; border-radius: 0px">
			Schedule
			The contest will start on March 27, 2020 at 3:00 PM +0600 and will run for 2 hours 30 minutes.
		</div>
	</div>
	<div class="col-md-4" style= "padding-left:0px">
		<div class="box_body" style="border-radius: 0px">
			<div class="well">
              <span id="hour" class="timer bg-primary">4</span>
              <span id="min" class="timer bg-primary">4</span>
              <span id="sec" class="timer bg-primary">4</span>
            </div>   
			<ul class="list-group">
          		<li class="list-group-item contest_info_li"><b>Contest ID:</b> <?php echo "cid"; ?></li>
          		<li class="list-group-item contest_info_li"><b>Contest Start:</b> <?php echo "start_time"; ?></li>
          		<li class="list-group-item contest_info_li"><b>Contest End:</b> <?php echo "end_time"; ?></li>
          		<li class="list-group-item contest_info_li"><b>Contest Duration:</b> <?php echo "length"; ?></li>
          		<li class="list-group-item contest_info_li"><b>Contest Type: </b> <?php echo "type"; ?></li>
        	</ul>
        	<div class="contestBtn">
        		<button>Enter Contest</button>
        		<button>Ranklist</button>
        		<button>Statistics</button>
        	</div>
        	
		</div>
	</div>
</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>

<script type="text/javascript">
  $.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function(){
    particlesJS('particles-js',
      {
        "particles": {
          "number": {
            "value": 100,
            "density": {
              "enable": true,
              "value_area": 800
            }
          },
          "color": {
            "value": "#ffffff"
          },
          "shape": {
            "type": "circle",
            "stroke": {
              "width": 0,
              "color": "#000000"
            },
            "polygon": {
              "nb_sides": 5
            },
            "image": {
              "width": 100,
              "height": 100
            }
          },
          "opacity": {
            "value": 0.5,
            "random": false,
            "anim": {
              "enable": false,
              "speed": 1,
              "opacity_min": 0.1,
              "sync": false
            }
          },
          "size": {
            "value": 5,
            "random": true,
            "anim": {
              "enable": false,
              "speed": 40,
              "size_min": 0.1,
              "sync": false
            }
          },
          "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
          },
          "move": {
            "enable": true,
            "speed": 6,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "out",
            "attract": {
              "enable": false,
              "rotateX": 600,
              "rotateY": 1200
            }
          }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": {
              "enable": true,
              "mode": "repulse"
            },
            "onclick": {
              "enable": true,
              "mode": "push"
            },
            "resize": true
          },
          "modes": {
            "grab": {
              "distance": 400,
              "line_linked": {
                "opacity": 1
              }
            },
            "bubble": {
              "distance": 400,
              "size": 40,
              "duration": 2,
              "opacity": 8,
              "speed": 3
            },
            "repulse": {
              "distance": 200
            },
            "push": {
              "particles_nb": 4
            },
            "remove": {
              "particles_nb": 2
            }
          }
        },
        "retina_detect": true,
        "config_demo": {
          "hide_card": false,
          "background_color": "#b61924",
          "background_image": "",
          "background_position": "50% 50%",
          "background_repeat": "no-repeat",
          "background_size": "cover"
        }
      }
    );

});


</script>