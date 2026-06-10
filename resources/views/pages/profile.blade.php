@extends('layouts.default')

@section('content')
<div class="profile-dashboard-wrapper">
    <div class="profile-dashboard-container">

        <!-- Main Content Area -->
        <div class="profile-dashboard-main">
            
            <!-- Dashboard Header -->
            <div class="profile-dashboard-header">
                <div class="profile-header-title">
                    <h2>{{__('front_end.header.hello')}}, {{ $user->first_name }}</h2>
                    <span id="current-date"></span>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Profile Form Card -->
            <form method="POST" action="/profile/edit/{{ $user->id }}" enctype="multipart/form-data">
                @csrf
                <div class="profile-detail-card">
                    
                    <!-- Profile Info Area -->
                    <div class="profile-detail-info">
                        <div class="profile-info-left">
                            <div class="profile-avatar-container">
                                <img src="{{ $user->fotos->first()?->path ? asset('storage/'. $user->fotos->first()?->path) : asset('/images/profilePicture.png') }}"
                                    class="profile-avatar-img" id="preview" alt="Picture">
                                
                                <div class="profile-avatar-upload-overlay">
                                    <x-heroicon-o-camera style="width:28px; height:28px;" />
                                </div>
                                
                                <input type="file" name="foto"
                                    class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                    style="cursor:pointer;" onchange="previewImage(event)">
                            </div>
                            <div class="profile-info-text">
                                <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                                <p>{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="profile-info-actions">
                            <a href="/" class="btn-profile-secondary">{{__('common.cancel')}}</a>
                            <button type="submit" class="btn-profile-primary">{{__('common.save')}}</button>
                        </div>
                    </div>

                    <!-- Profile Form Body -->
                    <div class="profile-form-body">
                        <div class="profile-form-grid">
                            
                            <!-- First Name Input -->
                            <div class="profile-input-group">
                                <label for="first_name">{{__('users.form.first_name')}}</label>
                                <input type="text" id="first_name" name="first_name"
                                    value="{{ $user->first_name }}" maxlength="15" required>
                            </div>

                            <!-- Last Name Input -->
                            <div class="profile-input-group">
                                <label for="last_name">{{__('users.form.last_name')}}</label>
                                <input type="text" id="last_name" name="last_name"
                                    value="{{ $user->last_name }}" maxlength="15" required>
                            </div>

                            <!-- Username Input -->
                            <div class="profile-input-group">
                                <label for="name">Username</label>
                                <input type="text" id="name" name="name"
                                    value="{{ $user->name }}" required>
                            </div>

                            <!-- Email Input -->
                            <div class="profile-input-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>

                        </div>

                        <!-- Email Management Area -->
                        <div class="profile-emails-section">
                            <h4 class="profile-emails-title">{{__('users.form.administrative_details_data')}}</h4>
                            <div class="profile-emails-list">
                                <div class="profile-email-item">
                                    <div class="profile-email-icon">
                                        <i class="fa-regular fa-envelope"></i>
                                    </div>
                                    <div class="profile-email-details">
                                        <span class="profile-email-address">{{ $user->email }}</span>
                                        <span class="profile-email-meta">Principal</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const img = document.getElementById('preview');

        if (input.files && input.files[0]) {
            img.src = URL.createObjectURL(input.files[0]);
            
            // Also update the header avatar image preview for a premium interactive feel
            const headerAvatar = document.querySelector('.profile-header-avatar');
            if (headerAvatar) {
                headerAvatar.src = URL.createObjectURL(input.files[0]);
            }
        }
    }

    // Dynamic localized date matching the mockup look
    document.addEventListener('DOMContentLoaded', function() {
        const options = { weekday: 'short', day: '2-digit', month: 'long', year: 'numeric' };
        const dateStr = new Date().toLocaleDateString('{{ app()->getLocale() == "en" ? "en-US" : "pt-PT" }}', options);
        const el = document.getElementById('current-date');
        if (el) el.textContent = dateStr;
    });
</script>
@endsection