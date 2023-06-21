<?php
function generateMenuItemID($title) {
    $id = strtolower(str_replace(' ', '-', $title));
    $id = preg_replace('/[^a-zA-Z0-9\-]/', '', $id);
    return $id;
}
function getURL(): string{
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $lastThree = array_slice($link_array, -3);
    return implode('/', $lastThree);
}

$menu = array(
    array(
        'title' => 'Dashboard',
        'icon' => 'bi bi-speedometer2',
        'link' => 'admin/dashboard'
    ),
    array(
        'title' => 'Users',
        'icon' => 'bi bi-people',
        'sub_menu' => array(
            array(
                'title' => 'Manage Users',
                'link' => 'admin/users/manage_users.php'
            ),
            array(
                'title' => 'Add new User',
                'link' => 'admin/users/add_user.php'
            )
        )
    ),
    array(
        'title' => 'Reports',
        'icon' => 'bi bi-file-earmark-bar-graph',
        'sub_menu' => array(
            array(
                'title' => 'Students Progress',
                'link' => 'admin/reports/user_performance.php'
            ),
            array(
                'title' => 'Assessment Results',
                'link' => 'admin/reports/assessment_results.php'
            )
        )
    )
);

?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <?php foreach ($menu as $item) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" <?php if(!isset($item['sub_menu'])) { ?> href="<?php echo root().$item['link'];  ?>" <?php }else{?>
                    data-bs-target="#<?= generateMenuItemID(strtolower(str_replace(' ', '', $item['title']))) ?>-nav" data-bs-toggle="collapse" href="#"<?php } ?>>
                    <i class="<?= $item['icon'] ?>"></i><span><?= $item['title'] ?></span>
                    <?php if(isset($item['sub_menu'])) { ?> <i class="bi bi-chevron-down ms-auto"></i> <?php } ?>
                </a>
                <?php if(isset($item['sub_menu'])) { ?>
                <ul id="<?= generateMenuItemID(strtolower(str_replace(' ', '', $item['title']))) ?>-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <?php foreach ($item['sub_menu'] as $sub_item) : ?>
                        <li>
                            <a href="<?= root().$sub_item['link'] ?>" <?php if($sub_item['link']==getURL()) echo "class='active'"; ?>>
                                <i class="bi bi-circle"></i><span><?= $sub_item['title'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php } ?>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>