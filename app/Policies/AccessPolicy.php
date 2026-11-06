<?php

namespace App\Policies;

use App\Models\User;
use App\Models\cuti;
use App\Models\Presensi;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccessPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function level1(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [1, 2, 3, 4]);
    }

    public function level2(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [2, 3, 4]);
    }

    public function level3(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [3, 4]);
    }

    public function level4(User $user)
    {
        return $user->karyawan->jabatan->level === 4;
    }

    public function view(User $user, Presensi $presensi)
    {
        return $user->karyawan->jabatan->level === 4 || $user->karyawan_id === $presensi->karyawan_id;
    }

    public function viewCuti(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [3, 4]);
    }

    public function approveCuti(User $user, Cuti $cuti)
    {
        return $user->karyawan->jabatan->level === 4;
    }

    public function canViewPenugasan(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [1, 2, 3, 4]);
    }

    public function canCreatePenugasan(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [1, 2, 3]);
    }

    public function canManagePenugasan(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [2, 3]);
    }

    public function canViewPresensi(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [1, 2, 3, 4]);
    }

    public function canManagePresensi(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canCreatePresensi(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [1, 2, 3, 4]);
    }

    public function canCreateCuti(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [1, 2, 3, 4]);
    }

    public function canManageCuti(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [3, 4]);
    }

    public function canManageKaryawan(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canManageLowongan(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canManageLamaran(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canManagePromosi(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canValidatePromosi(User $user)
    {
        return $user->karyawan->jabatan->level === 4;
    }

    public function canViewPromosi(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [3, 4]);
    }

    public function canManageDemosi(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canValidateDemosi(User $user)
    {
        return $user->karyawan->jabatan->level === 4;
    }

    public function canViewDemosi(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [3, 4]);
    }

    public function canManagePHK(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canValidatePHK(User $user)
    {
        return $user->karyawan->jabatan->level === 4;
    }

    public function canViewPHK(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [3, 4]);
    }

    public function canManageReward(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canManagePunishment(User $user)
    {
        return $user->karyawan->jabatan->level === 3;
    }

    public function canViewLaporan(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [3, 4]);
    }

    public function approvePHK(User $user)
    {
        return $user->karyawan->jabatan->level === 4;
    }

    public function approveDemosi(User $user)
    {
        return $user->karyawan->jabatan->level === 4;
    }

    public function approvePromosi(User $user)
    {
        return $user->karyawan->jabatan->level === 4;
    }
    public function canViewSuratPeringatan(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [1, 2, 3]);
    }
    public function canManageSuratPeringatan(User $user)
    {
        return in_array($user->karyawan->jabatan->level, [2, 3]);
    }
}
