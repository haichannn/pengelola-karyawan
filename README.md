project ini merupakan hasil belajar dari playlist php OOP (Object Oriented Programming) dari channel nya **WPU**
atau **Pak Sandhika Galih**, aplikasi ini bertema CRUD lalu menggunakan MySQL sebagai database nya.
aplikasi ini mengatur data karyawan seperti menambah, mengupdate dan menghapus data...


## Gallery
![indexPage](https://github.com/user-attachments/assets/39426853-21b9-43d5-a047-d8976c28e3a8)
![addPage](https://github.com/user-attachments/assets/c45f11d1-dc26-4f1c-9de9-8ad91e276288)
![updatePage](https://github.com/user-attachments/assets/285eb0cd-6432-4fb6-ad74-38a026dbe6c5)
![deletePage](https://github.com/user-attachments/assets/d3af9956-e620-4c15-bff7-895e3c707757)



## Cara install 
1. Install code editor ( **Vscode**, **Sublime Text**, etc.. )
2. Install web browser ( **Google chrome**, **Mozilla firefox**, etc.. )
3. Install php and apache2 atau pakai XAMPP
4. Clone repo ini, dan taruh di folder htdocs
5. Jalankan XAMPP, nyalakan MySQL dan Apache2 nya
6. Buka di browser, ketik localhost lalu cari folder yang anda simpan 


## Buat Database 
   _nama database boleh diganti di file **Config/database.php**_

      CREATE DATABASE project-pengelola-karyawan;

## Structure table 
### 1. Table karyawan

### Create table structure

    CREATE TABLE `karyawan` (
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `nama_lengkap` char(50) NOT NULL,
        `jenis_kelamin` enum('Pria','Perempuan') NOT NULL,
        `tanggal_lahir` date NOT NULL,
        `email` varchar(100) NOT NULL,
        `jabatan` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

### Add indexes

     ALTER TABLE `karyawan`
        ADD UNIQUE KEY `email` (`email`),
        ADD KEY `jabatan` (`jabatan`);

### Add constraints

     ALTER TABLE `karyawan`
        ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



### 2. Table jabatan

### Create table structure

      CREATE TABLE `jabatan` (
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `nama_jabatan` char(50) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

### Add data jabatan

      INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
         (1, 'Manager'),
         (2, 'HRD'),
         (3, 'Supervisor'),
         (4, 'Karyawan');


