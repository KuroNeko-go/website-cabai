<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <span><i class="fas fa-users"></i> Daftar Akun User & Admin</span>
        <a href="<?= base_url('admin_user/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus"></i> Tambah User Baru
        </a>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" style="border-radius: 12px;"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" style="border-radius: 12px;"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Info User</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Terakhir Login</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td>
                        <strong><?= $u['nama_lengkap'] ?></strong><br>
                        <small class="text-muted"><i class="fas fa-user"></i> <?= $u['username'] ?> | <i class="fas fa-envelope"></i> <?= $u['email'] ?></small>
                    </td>
                    <td>
                        <?php if (strtolower($u['role']) == 'admin'): ?>
                            <span class="badge badge-primary"><i class="fas fa-crown"></i> Admin</span>
                        <?php else: ?>
                            <span class="badge badge-info"><i class="fas fa-user"></i> User</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($u['is_active']): ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Di-Banned</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <small><?= $u['last_login'] ? date('d M Y H:i', strtotime($u['last_login'])) : 'Belum Pernah' ?></small>
                    </td>
                    <td>
                        <a href="<?= base_url('admin_user/edit/' . $u['id']) ?>" class="btn btn-sm btn-primary" style="padding: 5px 10px; margin-right: 5px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php if($u['id'] != $this->session->userdata('id_user')): ?>
                            <a href="<?= base_url('admin_user/delete/' . $u['id']) ?>" class="btn btn-sm btn-danger" style="padding: 5px 10px;" onclick="return confirm('Yakin ingin menghapus user ini selamanya?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>