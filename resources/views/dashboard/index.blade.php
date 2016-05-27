<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Dashboard Index
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    Dashboard / Bareos Reporter
@endsection

@section('content-header')
    <h1>Dashboard</h1>
@endsection

@section('content')
                <div class="row">
                    <div class="job-stat col-xs-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua">
                                <i class="ion ion-arrow-graph-up-right"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Report Jobs</span>
                                <span class="info-box-number">
                                    @if(!empty($statistics->job_count))
                                        {{ $statistics->job_count }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="email-stat col-xs-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-green">
                                <i class="ion ion-paper-airplane"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Emails Sent</span>
                                <span class="info-box-number">
                                    @if(!empty($statistics->emails_sent))
                                        {{ $statistics->emails_sent }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="contacts-stat col-xs-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-red">
                                <i class="ion ion-ios-people"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Invalid Contact Emails</span>
                                <span class="info-box-number">
                                    @if(!empty($statistics->invalid_contacts))
                                        {{ $statistics->invalid_contacts }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="catalogs-stat col-xs-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-blue">
                                <i class="ion ion-ios-book"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Invalid Catalog Connections</span>
                                <span class="info-box-number">
                                    @if(!empty($statistics->invalid_catalogs))
                                        {{ $statistics->invalid_catalogs }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
