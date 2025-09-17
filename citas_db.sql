-- Crear la base de datos
IF NOT EXISTS (SELECT name FROM sys.databases WHERE name = N'autos_premium')
BEGIN
    CREATE DATABASE autos_premium;
END
GO

USE autos_premium;
GO

-- Crear la tabla de citas
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='citas' AND xtype='U')
BEGIN
    CREATE TABLE citas (
        id INT IDENTITY(1,1) PRIMARY KEY,
        nombre NVARCHAR(100) NOT NULL,
        correo NVARCHAR(100) NOT NULL,
        fecha DATE NOT NULL,
        hora TIME NOT NULL,
        fecha_registro DATETIME DEFAULT GETDATE()
    );
END
GO