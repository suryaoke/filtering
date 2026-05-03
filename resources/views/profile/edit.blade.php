@extends('layouts.app')

@section('title', 'Update Profile')

@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update Profile
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="{{ $user->name }}" class="rounded-full" src="{{ asset('dist/images/profile-5.jpg') }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ $user->name }}</div>
                        <div class="text-slate-500">{{ $user->role ?? 'User' }}</div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center text-primary font-medium" href=""> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Personal Information </a>
                    <a class="flex items-center mt-5" href=""> <i data-lucide="box" class="w-4 h-4 mr-2"></i> Account Settings </a>
                    <a class="flex items-center mt-5" href=""> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Change Password </a>
                    <a class="flex items-center mt-5" href=""> <i data-lucide="settings" class="w-4 h-4 mr-2"></i> User Settings </a>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Display Information
                    </h2>
                </div>
                <div class="p-5">
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success show flex items-center mb-6" role="alert">
                            <i data-lucide="check-circle" class="w-6 h-6 mr-2"></i> Profile updated successfully.
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div>
                                            <label for="update-profile-form-1" class="form-label">Display Name</label>
                                            <input id="update-profile-form-1" name="name" type="text" class="form-control" placeholder="Input name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-2" class="form-label">Email</label>
                                            <input id="update-profile-form-2" name="email" type="email" class="form-control" placeholder="Input email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3 2xl:mt-0">
                                            <label for="update-profile-form-3" class="form-label">Role</label>
                                            <input id="update-profile-form-3" type="text" class="form-control" value="{{ $user->role }}" disabled>
                                        </div>
                                        <div class="mt-3">
                                            <label for="update-profile-form-4" class="form-label">Phone Number</label>
                                            <input id="update-profile-form-4" type="text" class="form-control" placeholder="Input phone number" value="628123456789" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt="{{ $user->name }}" src="{{ asset('dist/images/profile-5.jpg') }}">
                                        <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-primary w-full">Change Photo</button>
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 border-t border-slate-200/60 dark:border-darkmode-400 pt-5">
                            <h2 class="font-medium text-base mr-auto mb-5">Change Password</h2>
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 2xl:col-span-6">
                                    <div>
                                        <label for="change-password-form-1" class="form-label">Current Password</label>
                                        <input id="change-password-form-1" name="current_password" type="password" class="form-control" placeholder="Input current password">
                                        @error('current_password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="change-password-form-2" class="form-label">New Password</label>
                                        <input id="change-password-form-2" name="password" type="password" class="form-control" placeholder="Input new password">
                                        @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="change-password-form-3" class="form-label">Confirm New Password</label>
                                        <input id="change-password-form-3" name="password_confirmation" type="password" class="form-control" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-10">
                            <button type="submit" class="btn btn-primary w-24">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
@endsection
