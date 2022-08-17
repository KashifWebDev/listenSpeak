<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="adminDashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-fill"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="admin_registerStudent.php">
                        <i class="bi bi-circle"></i><span>Student Registration</span>
                    </a>
                </li>
                <li>
                    <a href="admin_allStudents.php">
                        <i class="bi bi-circle"></i><span>All Students</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-list-task"></i><span>Activities</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="admin_addActivity.php">
                        <i class="bi bi-circle"></i><span>Add Activity</span>
                    </a>
                </li>
                <li>
                    <a href="admin_allActivities.php">
                        <i class="bi bi-circle"></i><span>All Activities</span>
                    </a>
                </li>
                <li>
                    <a href="admin_activitySettings.php">
                        <i class="bi bi-circle"></i><span>Activity Settings</span>
                    </a>
                </li>
            </ul>
        </li>



    </ul>

</aside>