<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Sidebar Navigation
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

$active_director = \Illuminate\Support\Facades\Session::get('active_director');
?>
<aside class="main-sidebar">
    <!-- Sidebar -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">
                NAVIGATION
            </li>
            <li>
                <a href="{{ url('/dashboard') }}">
                    <i class="fa fa-tachometer" ></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/directors') }}">
                    <i class="fa fa-server" ></i>
                    <span>Directors</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/clients') }}">
                    <i class="fa fa-desktop" ></i>
                    <span>Clients</span>
                </a>
            </li>
            @if(!empty($active_director) && $active_director != -1)
                <li>
                    <a href="{{ url('/jobs/'.$active_director) }}">
                        <i class="fa fa-line-chart" ></i>
                        <span>Jobs</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ url('/schedules') }}">
                    <i class="fa fa-clock-o" ></i>
                    <span>Schedules</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/templates') }}">
                    <i class="fa fa-file" ></i>
                    <span>Templates</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/contacts') }}">
                    <i class="fa fa-users" ></i>
                    <span>Contacts</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs" ></i>
                    <span>Settings</span>
                    <i class="fa fa-angle-left pull-right" ></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ url('/settings/users') }}">
                            <i class="fa fa-user"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/settings/email') }}">
                            <i class="fa fa-envelope"></i>
                            <span>Email Settings</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
