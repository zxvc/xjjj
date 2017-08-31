<?php
header("Content-Type: text/html;charset=utf-8");
require ("../config/conn.php");//引入链接数据库
require_once ("include-power.php");//引入权限判断
require_once ("include-image.php");
    if(!empty($_POST['btnEdit']))
    {
        $menu_id=$_REQUEST['menu_id'];
        $menu_images=$_REQUEST['menu_images'];
        $img=$files->upload_image("menu_image", $upload, $menu_images, $menu_width, $menu_height);
        if($img=="Out of size")
        {
            echo IMAGE_SIZE;
            return;
        }
        else if($img=="error in type")
        {
            echo IMAGE_FORMAT;
            return;
        }
        else
        {
            $menu_image=$img;
        }
        if(empty($menu_image))
        {
            $Log_name=$_COOKIE['login'];
            $Log_event=WORD_EDIT.WORD_BRANCH.IMPLEMENT_FAIL;
            $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
            echo ADD_FAIL_IMAGE;
        }
        else
        {
            $menu_wap_images=$_REQUEST['menu_wap_images'];
            $img_wap=$files->upload_image("menu_wap_image", $upload, $menu_wap_images, $menu_wap_width, $menu_wap_height);
            if($img_wap=="Out of size")
            {
                echo IMAGE_SIZE;
                return;
            }
            else if($img_wap=="error in type")
            {
                echo IMAGE_FORMAT;
                return;
            }
            else
            {
                $menu_wap_image=$img_wap;
            }
            if(empty($menu_wap_image))
            {
                $Log_name=$_COOKIE['login'];
                $Log_event=WORD_EDIT.WORD_BRANCH.IMPLEMENT_FAIL;
                $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                echo ADD_FAIL_IMAGE;
            }
            else
            {
                $sql = "update menu set menu_image='$menu_image',menu_wap_image='$menu_wap_image' where menu_id='$menu_id'";
                $rows = $db->edit_list($sql);
                if($rows >= 1)
                {
                    $Log_name=$_COOKIE['login'];
                    $Log_event=WORD_EDIT."“".$menu_title."”".WORD_BRANCH.IMPLEMENT_SUCCESS;
                    $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                    echo "<script>alert('".EDIT_SUCCESS."');location.href=\"select.php\";</script>";
                }
                else
                {
                    $Log_name=$_COOKIE['login'];
                    $Log_event=WORD_EDIT."“".$menu_title."”".WORD_BRANCH.IMPLEMENT_FAIL;
                    $db->edit_list("insert into log (Log_name,Log_event)values('$Log_name','$Log_event')");
                    echo "<script>alert('".EDIT_FAIL."');location.href=\"select.php\";</script>";
                }
            }
        }
    }