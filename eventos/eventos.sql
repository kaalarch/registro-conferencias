create database Eventos;
use Eventos;
create table Usuario
(id_usuario char(50) primary key not null,
 nombre text NOT NULL,
 correo text NOT NULL,
 contrasenia text NOT NULL);
 
  create table Evento
 (id_evento int primary key auto_increment,
  nombre text,
  fecha text ,
  lugar text,
  capacidad int,
  ocupados int);
  
  create table Historial
  (id_usuario char(50) not null,
  id_evento int not null,
  primary key(id_usuario, id_evento));
  
alter table Historial add foreign key (id_usuario) references Usuario (id_usuario);
alter table Historial add foreign key (id_evento) references Evento (id_evento);
 
 insert into Usuario /*(nombre, apellido_paterno, apellido_materno, telefono, correo, fecha_de_nacimiento, contrasenia)*/
 values('ramiromiro', 'Ramiro Serrato Andrade','ramiromiro98@gmail.com','ramiro');
 
 insert into Evento
 values(2, 'Semana de la Administración Industrial', '02/01/2021', 'Sociales', 100, 0);
 
  insert into Evento
 values(1, 'Conferencia Infromática', '06/08/2019', 'Pesados', 100, 0);
 
 insert into Evento
 values(3, 'Partido UPIICSA vs ESIME', '16/01/2020', 'Canchas', 2, 0);
 
 select * from Usuario;
 select * from Evento;
 select * from Historial;
 
 delete from Historial; 
 delete from Evento;
 
 select Evento.id_evento, Evento.nombre, Evento.fecha, Evento.lugar from Historial
 inner join Usuario
 inner join Evento
 on Historial.id_usuario = Usuario.id_usuario
 and Historial.id_evento = Evento.id_evento
 where Usuario.id_usuario = 'ramiromiro';
 
 
