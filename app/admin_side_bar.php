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
        'title' => 'Courses',
        'icon' => 'bi bi-book',
        'sub_menu' => array(
            array(
                'title' => 'Manage Courses',
                'link' => 'admin/courses/manage_courses.php'
            ),
            array(
                'title' => 'Add New Course',
                'link' => 'admin/courses/add_course.php'
            ),
            array(
                'title' => 'Assign Instructors',
                'link' => 'admin/courses/assign_instructors.php'
            )
        )
    ),
    array(
        'title' => 'Subjects',
        'icon' => 'bi bi-journal-text',
        'sub_menu' => array(
            array(
                'title' => 'Manage Subjects',
                'link' => 'admin/subjects/manage_subjects.php'
            ),
            array(
                'title' => 'Add New Subject',
                'link' => 'admin/subjects/add_subject.php'
            ),
            array(
                'title' => 'Subject Settings',
                'link' => 'admin/subjects/subject_settings.php'
            ),
            array(
                'title' => 'Assign Instructors',
                'link' => 'admin/subjects/assign_instructors.php'
            ),
            array(
                'title' => 'Prerequisites',
                'link' => 'admin/subjects/prerequisites.php'
            )
        )
    ),
    array(
        'title' => 'Units',
        'icon' => 'bi bi-grid',
        'sub_menu' => array(
            array(
                'title' => 'Manage Units',
                'link' => 'admin/units/manage_units.php'
            ),
            array(
                'title' => 'Add New Unit',
                'link' => 'admin/units/add_unit.php'
            ),
            array(
                'title' => 'Unit Settings',
                'link' => 'admin/units/unit_settings.php'
            ),
            array(
                'title' => 'Prerequisites',
                'link' => 'admin/units/prerequisites.php'
            ),
            array(
                'title' => 'Review Submissions',
                'link' => 'admin/units/review_submissions.php'
            )
        )
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
                'title' => 'Add New User',
                'link' => 'admin/users/add_user.php'
            ),
            array(
                'title' => 'User Roles',
                'link' => 'admin/users/user_roles.php'
            ),
            array(
                'title' => 'User Activity',
                'link' => 'admin/users/user_activity.php'
            ),
            array(
                'title' =>'User Progress',
                'link' => 'admin/users/user_progress.php'
            )
        )
    ),
    array(
        'title' => 'Assessments',
        'icon' => 'bi bi-file-earmark-bar-graph',
        'sub_menu' => array(
            array(
                'title' => 'Manage Assessments',
                'link' => 'admin/assessments/manage_assessments.php'
            ),
            array(
                'title' => 'Create New Assessment',
                'link' => 'admin/assessments/create_assessment.php'
            ),
            array(
                'title' => 'Assessment Settings',
                'link' => 'admin/assessments/assessment_settings.php'
            ),
            array(
                'title' => 'Grade Assessments',
                'link' => 'admin/assessments/grade_assessments.php'
            ),
            array(
                'title' => 'Assessment Reports',
                'link' => 'admin/assessments/assessment_reports.php'
            )
        )
    ),
    array(
        'title' => 'Reports',
        'icon' => 'bi bi-file-earmark-bar-graph',
        'sub_menu' => array(
            array(
                'title' => 'Course Progress',
                'link' => 'admin/reports/course_progress.php'
            ),
            array(
                'title' => 'User Activity',
                'link' => 'admin/reports/user_activity.php'
            ),
            array(
                'title' => 'User Performance',
                'link' => 'admin/reports/user_performance.php'
            ),
            array(
                'title' => 'Assessment Results',
                'link' => 'admin/reports/assessment_results.php'
            ),
            array(
                'title' => 'Statistics',
                'link' => 'admin/reports/statistics.php'
            )
        )
    ),
    array(
        'title' => 'Settings',
        'icon' => 'bi bi-gear',
        'sub_menu' => array(
            array(
                'title' => 'System Configuration',
                'link' => 'admin/settings/system_configuration.php'
            ),
            array(
                'title' => 'Email Notifications',
                'link' => 'admin/settings/email_notifications.php'
            ),
            array(
                'title' => 'Language Settings',
                'link' => 'admin/settings/language_settings.php'
            ),
            array(
                'title' => 'Integrations',
                'link' => 'admin/settings/integrations.php'
            ),
            array(
                'title' => 'Plugin Management',
                'link' => 'admin/settings/plugin_management.php'
            )
        )
    ),
    array(
        'title' => 'Notifications',
        'icon' => 'bi bi-bell',
        'sub_menu' => array(
            array(
                'title' => 'Manage Notifications',
                'link' => 'admin/notifications/manage_notifications.php'
            ),
            array(
                'title' => 'Broadcast Messages',
                'link' => 'admin/notifications/broadcast_messages.php'
            ),
            array(
                'title' => 'Schedule Notifications',
                'link' => 'admin/notifications/schedule_notifications.php'
            ),
            array(
                'title' => 'Delivery Tracking',
                'link' => 'admin/notifications/delivery_tracking.php'
            ),
            array(
                'title' => 'Read Receipts',
                'link' => 'admin/notifications/read_receipts.php'
            )
        )
    ),
    array(
        'title' => 'Help & Support',
        'icon' => 'bi bi-question-circle',
        'sub_menu' => array(
            array(
                'title' => 'Documentation',
                'link' => 'admin/help/documentation.php'
            ),
            array(
                'title' => 'Support Requests',
                'link' => 'admin/help/support_requests.php'
            ),
            array(
                'title' => 'System Updates',
                'link' => 'admin/help/system_updates.php'
            ),
            array(
                'title' => 'Contact Support',
                'link' => 'admin/help/contact_support.php'
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