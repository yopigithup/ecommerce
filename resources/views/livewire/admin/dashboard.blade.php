<!-- resources/views/livewire/admin/dashboard.blade.php -->



@extends('layouts.app') <!-- Adjust the layout as per your application's structure -->

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="row">
            <div class="col-md-12">
                <h2>Welcome, {{ auth()->user()->name }}</h2>
            </div>
        </div>

        <div class="mt-4 row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        User Management
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a href="{{ route('admin.users.index') }}">View Users</a></li>
                            <li><a href="{{ route('admin.users.create') }}">Add User</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Reports
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a href="{{ route('admin.reports.index') }}">View Reports</a></li>
                            <li><a href="{{ route('admin.reports.create') }}">Generate Report</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Settings
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a href="{{ route('admin.settings.index') }}">Site Settings</a></li>
                            <li><a href="{{ route('admin.roles.index') }}">Manage Roles</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 row">
            <div class="col-md-12">
                <h3>Recent Activity</h3>
                <!-- Example of a table for recent activity -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows, replace with dynamic data -->
                        <tr>
                            <td>John Doe</td>
                            <td>Logged in</td>
                            <td>2024-09-29 10:00 AM</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Created a new post</td>
                            <td>2024-09-29 10:05 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
