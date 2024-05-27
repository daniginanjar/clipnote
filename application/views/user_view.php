<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>
    <h2>Create User</h2>
    <form action="<?= base_url('user/create') ?>" method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Create</button>
    </form>

    <h2>Users List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <a href="<?= base_url('user/edit/'.$user['id']) ?>">Edit</a>
                        <a href="<?= base_url('user/delete/'.$user['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
        if(isset($data['note'])){
            echo $data['note'];
        } else{
            echo 'hadeh';
        }
    ?>

    <?php if (isset($data['coba'])){

    } ?>
        <h2>Edit User</h2>
        <form action="<?= base_url('user/update/'.$user['id']) ?>" method="post">
            <input type="text" name="name" value="<?= $user['username'] ?>" required>
            <input type="email" name="email" value="<?= $user['email'] ?>" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Update</button>
        </form>
    <?php  ?>
</body>
</html>