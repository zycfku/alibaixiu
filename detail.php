
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <?php include 'public/public.php' ?>
    <div class="content">
      <div class="article">
        <!-- <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;">奇趣事</a></dd>
            <dd>变废为宝！将手机旧电池变为充电宝的Better RE移动电源</dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;">又现酒窝夹笔盖新技能 城里人是不让人活了！</a>
        </h2>
        <div class="meta">
          <span>DUX主题小秘 发布于 2015-06-29</span>
          <span>分类: <a href="javascript:;">奇趣事</a></span>
          <span>阅读: (2421)</span>
          <span>评论: (143)</span>
        </div>
        <div class="content-detail"></div>
        -->
      </div> 
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
<script src="assets/vendors/jquery/jquery.min.js"></script>
<script src="template.js"></script>
<script type="text/template" id="detailData">
{{each list as v k}}

        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;">{{v.name}}</a></dd>
            <dd>变废为宝！将手机旧电池变为充电宝的Better RE移动电源</dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;">{{v.title}}</a>
        </h2>
        <div class="meta">
          <span>{{v.nickname}} 发布于 {{v.created}}</span>
          <span>分类: <a href="javascript:;">{{v.name}}</a></span>
          <span>阅读: ({{v.views}})</span>
          <span>评论: ({{v.comments}})</span>
        </div>
        <div class="content-detail">{{v.content}}</div>
        <!-- <a href="javascript:;" class="thumb">
              <img src="{{v.feature}}" alt="">
            </a> -->
    
  
{{/each}}
</script>

<script>
  
  var slug = location.search.split('=')[1];
 $.ajax({
   type: 'post',
   url: 'api/getDetail.php',
   data: {
     slug: slug
   },
   dataType: 'json',
   success: function(res){
     console.log(res);
     
     var str = template('detailData',{list: res.data});
     $('.article').html(str);
     
   }
 })
</script>
</body>
</html>
