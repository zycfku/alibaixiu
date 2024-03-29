<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>
  <script>
    NProgress.start()
  </script>

  <div class="main">
    <?php include 'public/nav.php' ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display: none;">
        <strong>错误！</strong>发生XXX错误
      </div>
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <label for="slug">类名</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="classname">
            </div>
            <div class="form-group">
              <button class="btn btn-primary add" type="button">添加</button>
              <button class="btn btn-primary edit" type="button">编辑</button>
              <button class="btn btn-primary" type="button">取消</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox" id="checkboxall"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td>classname</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php $posts = 'categories' ?>
  <?php include 'public/aside.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../template.js"></script>
  <script type="text/template" id="cateData">
    {{each list as v k}}
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td>{{v.name}}</td>
      <td>{{v.slug}}</td>
      <td>{{v.classname}}</td>
      <td class="text-center">
        <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
    {{/each}}
  </script>
  
  <script>
    NProgress.done();
  </script>
  <script>
    function render() {
      $.ajax({
        type: 'post',
        url: 'api/getCategories.php',
        dataType: 'json',
        success: function(res) {
          if (res.code == 1) {
            var str = template('cateData', {
              list: res.data
            });
            $('tbody').html(str);
          }
        }
      });
    }
    render();
    $('tbody').on('click', '.btn-info', function() {
      let td = $(this).parents('tr').children();
      let name = td.eq(1).text();
      let slug = td.eq(2).text();
      let classname = td.eq(3).text();
      var that = this;
      $('#name').val(name);
      $('#slug').val(slug);
      $('#classname').val(classname);
    $('.edit').on('click',function(){
      let namenew =$('#name').val();
      let slugnew =$('#slug').val();
      let classnamenew = $('#classname').val();
        $.ajax({
        url: 'api/update.php',
        type: 'post',
        dataType: 'json',
        data: {
          name: namenew,
          slug: slug,
          classname: classnamenew,
          slugnew: slugnew
        },
        success: function(res){
          if(res.code ==1) {
            $(that).parents('tr').children().eq(1).text(namenew);
            $(that).parents('tr').children().eq(2).text(slugnew);
            $(that).parents('tr').children().eq(3).text(classnamenew);
            $('#name').val('');
            $('#slug').val('');
            $('#classname').val('');
          }
        }
      });
    })
    });
    
    $('tbody').on('click', '.btn-danger', function() {
      if(window.confirm('确定要删除吗？')){
      let slug = $(this).parents('tr').children().eq(2).text();
      $.ajax({
        type: 'post',
        url: 'api/delete.php',
        data: {
          slug: slug
        },
        dataType: 'json',
        success: function(res) {
          if (res.code == 1) {
            render();

          }
        }
      })
      };
    });
    $('.add').on('click', function() {
      let name = $('#name').val();
      let slug = $('#slug').val();
      let classname = $('#classname').val();
      if(name == '' || slug == '' || classname == '') {
        $('.alert-danger').show().fadeOut(2000);
         $('.alert-danger').text('输入值不能为空');
      }else{
      $.ajax({
        type: 'post',
        url: 'api/add.php',
        data: {
          name: name,
          slug: slug,
          classname: classname
        },
        dataType: 'json',
        success: function(res) {
          if (res.code == 1) {
            $('#name').val('');
            $('#slug').val('');
            $('#classname').val('');
            var str='<tr>\n' +
                                '  <td class="text-center"><input type="checkbox"></td>\n' +
                                '  <td>'+name+'</td>\n' +
                                '  <td>'+slug+'</td>\n' +
                                '  <td>'+classname+'</td>\n' +
                                '  <td class="text-center">\n' +
                                '    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>\n' +
                                '    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>\n' +
                                '  </td>\n' +
                                '</tr>';
                            $('tbody').append(str);
          }
        }
      })
      }
    });

    
  </script>
</body>

</html>