<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ccard</title>
    <link rel="stylesheet" href="/Public/Dcard/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Dcard/css/style.css">
</head>

<body>
    <div class="container navbar-fixed-top fix_head">
        <div class="navbar-header">
            <a href="<?php echo u('Index/index');?>"><p class="logo">Ccard</p></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <form action="<?php echo u('Index/index');?>" class="navbar-form " method="get">
                <ul class="nav navbar-nav search_ul " style="padding-left: 50px ">
                    <li class="form-group">
                        <input type="text" name="title" class="form-inline form-control" placeholder="搜尋">
                    </li>
                    <li class="form-group">
                        <select name="class" id="" class="form-inline form-control">
                            <option value="">分類</option>
                            <?php if(is_array($classif)): foreach($classif as $key=>$vo): ?><option value="<?php echo ($vo[title]); ?>"><?php echo ($vo[title]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </li>
                    <li class="form-group">
                        <input type="submit" class="btn btn-default" value="搜尋">
                    </li>
                </ul>
            </form>
        </div>
    </div>
<div class="container fix_content">
<a href="<?php echo u('Index/index');?>?class=<?php echo ($article["classif"]); ?>"><span class="label label-warning"><?php echo ($article["classif"]); ?></span></a>
<h2><?php echo ($article[title]); ?></h2>
<div>
<?php echo ($article[content]); ?>
</div>
<a href="<?php echo ($article[url]); ?>">原文章</a>
<br>
</div>

    <footer>
        <div class="container">
            <br>
            <div class="copyright-r">
                <p>©Ccard</p>
                E-mail:<a href="mailto:micwings@gmail.com">micwings@gmail.com</a></p>
            </div>
        </div>
    </footer>
</body>
<script src="/Public/Dcard/js/jquery/jquery-1.12.4.js"></script>
<script src="/Public/Dcard/js/bootstrap.min.js"></script>

</html>
<script>
</script>