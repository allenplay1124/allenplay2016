<h2>佈景參數</h2>
<form method="post" action="" id="form1">
    <table>
        <tr>
            <th>
                首頁主題
            </th>
            <th>
                包含分類
            </th>
            <th>
                排序
            </th>
            <th>
                動作
            </th>
        </tr>
        <?php if(isset($_str_all_index_subject)) { ?>
            <?php foreach($_str_all_index_subject as $key => $val) { ?>
                <tr>
                    <td>
                        <input type="text" name="subject[<?php echo $key ?>][name]" value="<?php echo $val['name'] ?>">
                    </td>
                    <td>
                        <input type="text" name="subject[<?php echo $key ?>][sort]" value="<?php echo $val['sort'] ?>">
                    </td>
                    <td>
                        <button type="submit" name="del" value="<?php echo $key ?>">刪除</button>
                    </td>
                <tr>
            <?php } ?>
        <?php } ?>
        <tr>
            <td>
                <input type="`text`" name="subject[<?php if(isset($key)) echo $key + 1 ?>][name]" value="">
            </td>
            <td>
                <input type="`text`" name="subject[<?php if(isset($key)) echo $key + 1 ?>][sort]" value="<?php if(isset($key)){
                    echo $key + 1;
                } else {
                    echo 1;
                } ?>">
            </td>
            <td>
                <button type="submit" name="add">新增</button>
            </td>
        </tr>
    </table>
</form>
