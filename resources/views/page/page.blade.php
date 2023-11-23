<?php
if ($current_page > 3) {
    $first_page = 1;
    ?>
<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>"><i class="fa fa-angle-double-left"></i></a>
<?php
}
if ($current_page > 1) {
    $prev_page = $current_page - 1;
    ?>
<a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>"><i class="fa fa-angle-left"></i></a>
<?php }
?>
<?php for ($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if ($num != $current_page) { ?>
        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
            <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
        <?php } ?>
    <?php } else { ?>
        <strong class="numss page-item"><?= $num ?></strong>
    <?php } ?>
<?php } ?>
<?php
if ($current_page < $totalPages - 1) {
    $next_page = $current_page + 1;
    ?>
    <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>"><i class="fa fa-angle-right"></i></a>
<?php
}
if ($current_page < $totalPages - 3) {
    $end_page = $totalPages;
    ?>
    <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>"><i class="fa fa-angle-double-right"></i></a>
<?php } ?>