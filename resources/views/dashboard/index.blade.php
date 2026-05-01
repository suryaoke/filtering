@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $stats['total_sales'] }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Sales</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="package" class="report-box__icon text-pending"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $stats['total_products'] }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Products</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="activity" class="report-box__icon text-warning"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $stats['total_followups'] }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Follow-ups</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-success"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $stats['total_users'] }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            
            <!-- BEGIN: Recent Sales -->
            <div class="col-span-12 mt-6">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Recent Sales
                    </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                    <table class="table table-report sm:mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">COMPANY</th>
                                <th class="whitespace-nowrap">CONTACT</th>
                                <th class="whitespace-nowrap">PRODUCT</th>
                                <th class="text-center whitespace-nowrap">DATE</th>
                                <th class="text-center whitespace-nowrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSales as $sale)
                            <tr class="intro-x">
                                <td class="font-medium whitespace-nowrap">{{ $sale->company_name }}</td>
                                <td class="whitespace-nowrap">{{ $sale->contact_name }}</td>
                                <td class="whitespace-nowrap">{{ $sale->product ? $sale->product->name : '-' }}</td>
                                <td class="text-center whitespace-nowrap">{{ $sale->created_at->format('d M Y') }}</td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{ route('sales.index') }}"> <i data-lucide="eye" class="w-4 h-4 mr-1"></i> View </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Recent Sales -->
        </div>
    </div>
</div>
@endsection
