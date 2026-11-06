<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\AccessPolicy;
use App\Models\User;
use App\Models\Presensi;
use App\Models\cuti;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => AccessPolicy::class,
        Presensi::class => AccessPolicy::class,
        cuti::class => AccessPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Backward compatibility gates
        Gate::define('level1', [AccessPolicy::class, 'level1']);
        Gate::define('level2', [AccessPolicy::class, 'level2']);
        Gate::define('level3', [AccessPolicy::class, 'level3']);
        Gate::define('level4', [AccessPolicy::class, 'level4']);
        Gate::define('approveCuti', [AccessPolicy::class, 'approveCuti']);

        // Penugasan permissions
        Gate::define('canViewPenugasan', [AccessPolicy::class, 'canViewPenugasan']);
        Gate::define('canCreatePenugasan', [AccessPolicy::class, 'canCreatePenugasan']);
        Gate::define('canManagePenugasan', [AccessPolicy::class, 'canManagePenugasan']);

        // Presensi permissions
        Gate::define('canViewPresensi', [AccessPolicy::class, 'canViewPresensi']);
        Gate::define('canManagePresensi', [AccessPolicy::class, 'canManagePresensi']);
        Gate::define('canCreatePresensi', [AccessPolicy::class, 'canCreatePresensi']);

        // Cuti permissions
        Gate::define('canCreateCuti', [AccessPolicy::class, 'canCreateCuti']);
        Gate::define('canManageCuti', [AccessPolicy::class, 'canManageCuti']);

        // Karyawan permissions
        Gate::define('canManageKaryawan', [AccessPolicy::class, 'canManageKaryawan']);

        // Lowongan & Lamaran permissions
        Gate::define('canManageLowongan', [AccessPolicy::class, 'canManageLowongan']);
        Gate::define('canManageLamaran', [AccessPolicy::class, 'canManageLamaran']);

        // Promosi permissions
        Gate::define('canManagePromosi', [AccessPolicy::class, 'canManagePromosi']);
        Gate::define('canValidatePromosi', [AccessPolicy::class, 'canValidatePromosi']);
        Gate::define('canViewPromosi', [AccessPolicy::class, 'canViewPromosi']);
        Gate::define('approvePromosi', [AccessPolicy::class, 'approvePromosi']);

        // Demosi permissions
        Gate::define('canManageDemosi', [AccessPolicy::class, 'canManageDemosi']);
        Gate::define('canValidateDemosi', [AccessPolicy::class, 'canValidateDemosi']);
        Gate::define('canViewDemosi', [AccessPolicy::class, 'canViewDemosi']);
        Gate::define('approveDemosi', [AccessPolicy::class, 'approveDemosi']);

        // PHK permissions
        Gate::define('canManagePHK', [AccessPolicy::class, 'canManagePHK']);
        Gate::define('canValidatePHK', [AccessPolicy::class, 'canValidatePHK']);
        Gate::define('canViewPHK', [AccessPolicy::class, 'canViewPHK']);
        Gate::define('approvePHK', [AccessPolicy::class, 'approvePHK']);

        // Reward & Punishment permissions
        Gate::define('canManageReward', [AccessPolicy::class, 'canManageReward']);
        Gate::define('canManagePunishment', [AccessPolicy::class, 'canManagePunishment']);

        // Laporan permissions
        Gate::define('canViewLaporan', [AccessPolicy::class, 'canViewLaporan']);

        // Surat Peringatan permissions
        Gate::define('canViewSuratPeringatan', [AccessPolicy::class, 'canViewSuratPeringatan']);
        Gate::define('canManageSuratPeringatan', [AccessPolicy::class, 'canManageSuratPeringatan']);
    }
}
