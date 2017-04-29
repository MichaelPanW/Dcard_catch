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
            <a href="<?php echo u('Index/index');?>">
                <p class="logo">Ccard</p>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <form action="<?php echo u('Index/index');?>" class="navbar-form form-inline " method="get" role="form">
                <ul class="nav navbar-nav search_ul " style="padding-left: 50px ">
                    <li class="form-group">
                        <input type="text" name="title" class="form-inline form-control" placeholder="搜尋" value="<?php echo ($_GET['title']); ?>">
                    </li>
                    <li class="form-group">
                        <select name="class" id="" class="form-inline form-control">
                            <option value="">分類</option>
                            <?php if(is_array($classif)): foreach($classif as $key=>$vo): if($_GET['class'] == $vo[title]): ?><option value="<?php echo ($vo[title]); ?>" selected><?php echo ($vo[title]); ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo ($vo[title]); ?>"><?php echo ($vo[title]); ?></option><?php endif; endforeach; endif; ?>
                        </select>
                    </li>
                    <li class="form-group">
                        <input type="submit" class="btn btn-default" value="搜尋">
                    </li>
                </ul>
                <br>
                <div class="checkbox form-group" style="color:#fff;float:right">
                    <label>
                        <?php if($_GET['hidd'] == 1): ?><input type="checkbox" name="hidd" value="1" checked>
                            <?php else: ?>
                            <input type="checkbox" name="hidd" value="1"><?php endif; ?>
                        已消失
                    </label>
                </div>
            </form>
        </div>
    </div>

<div class="container fix_content">
    <div class="btn-group">
        <?php echo ($pageShowA); ?></div>
    <ul class="nav nav-sidebar">
        <?php if(is_array($article)): foreach($article as $key=>$vo): ?><li>
                <a href="<?php echo u('Index/show');?>?id=<?php echo ($vo["id"]); ?>">
                    <h4>
            <span class="label label-warning"><?php echo ($vo["classif"]); ?></span>
            <?php echo ($vo[title]); ?>
            </h4>
                    <p><?php echo (mb_substr($vo['content'],0,100,'utf-8')); ?></p>
                </a>
            </li><?php endforeach; endif; ?>
    </ul>
    <div class="btn-group pull-right">
        <?php echo ($pageShowA); ?></div>
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