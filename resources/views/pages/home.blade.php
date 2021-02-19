@extends($layout)
@section('title', 'Welcome TO Online Judge')

@section('content')
{{$layout}}
<div class="row">
   
   <div class="col-md-12">
      <style type="text/css">
   .welcomeBanner{
      width: 100%;
      height: 250px;
   }
   .bannerArea{
      text-align: center;
   }
   .logoTitle{
      font-size: 35px;
      text-align: center;
      margin-bottom: 10px;
      color: #020202;
      border: 1px solid #f5f5f5;
      color: var(--bg-color);
      padding: 5px 5px 5px 5px;
      border-width: 0px 0px 2px 0px;
      margin: -15px -15px 10px -15px;
      color: var(--bg-color);
      -webkit-text-fill-color: #eeeeee; /* Will override color (regardless of order) */
      -webkit-text-stroke-width: 0.04em;
      -webkit-text-stroke-color: var(--bg-color);
   }
   .welcomeInfo{
      font-size: 1.26em;
      text-align: justify;
      font-family: New Century Schoolbook, serif;
      margin-top: 60px;
   }
   .bannerImg{
      height: 180px;
      width: 100%;
   }
   .welcomeFeature{
      height: 200px;
      margin-top: 10px;
      text-align: center;
      box-shadow: 1 1 3px 3px #aaaaaa;
   }
   .featureIcon{
      font-size: 5.5em;
      color: #7f8c8d;
      margin-top: 10px;
   }
   .featureName{
      font-size: 18px;
      margin-top: 25px;
      font-weight: bold;
      color: #7f8c8d;
      font-family: "Times New Roman", Times, serif;
   }
   .welcomeFeature:hover{
      cursor: pointer;
      font-size: 15px;
      background: url('file/site_metarial/geometry.png');
   }
</style>
   <div class="box">
   <div class="body" style="padding: 15px 15px 20px 15px;">
      <div class="logoTitle">Welcome To Coder Online Judge (CoderOJ) </div>
      
      <div class="row" style="background: url('http://localhost/project/Online-Judge/file/site_metarial/geometry.png');">
         <div class="col-md-4">
            <div class="bannerArea">
               <img class="welcomeBanner" src="http://coderoj.com/file/site_metarial/home-pic.png">
            </div>
         </div>
         <div class="col-md-8">
            <div class="welcomeInfo">
               Coder Online Judge is an Online Programming Practice and Contest Platform. It is maintained by a group of competitive programmers from Dept. of Computer Science Engineering, East West University. It is still under development and running in α version. This judge still needs lots of improvement and feature. Any suggestion will be appreciated. Happy Coding...
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-3 col-sm-6">
      <div class="box box-body welcomeFeature" style="background: url('file/site_metarial/geometry.png');">
         <div class="featureName">Organize a Contest</div>
         <i class="fas fa-trophy featureIcon"></i>
      </div>
   </div>
   <div class="col-md-3 col-sm-6">
      <div class="box box-body welcomeFeature" style="background: url('file/site_metarial/geometry.png');">
         <div class="featureName">Solve Problem</div>
         <i class="fas fa-list featureIcon"></i>
      </div>
   </div>
   <div class="col-md-3 col-sm-6">
      <div class="box box-body welcomeFeature" style="background: url('file/site_metarial/geometry.png');">
         <div class="featureName">Create Problem</div>
         <i class="fas fa-random featureIcon"></i>
      </div>
   </div>
   <div class="col-md-3 col-sm-6">
      <div class="box box-body welcomeFeature" style="background: url('file/site_metarial/geometry.png');">
         <div class="featureName">Progress Skill</div>
         <i class="fas fa-network-wired featureIcon"></i>
      </div>
   </div>
</div>   </div>

</div>
@stop