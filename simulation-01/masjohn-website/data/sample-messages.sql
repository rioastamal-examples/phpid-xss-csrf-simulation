DELETE FROM messages;
INSERT INTO messages VALUES
('12345678', 'Mas Joko', 'joko@example.com', '', 'Halo Mas John,' || CHAR(10) || CHAR(10) || 'Saya ingin membuat website usaha dagang saya? berapa ya harganya.', '2021-04-19T03:52:08+07:00'),
('12345678', 'Mas Parto', 'parto@example.com', '', 'Mas John,' || CHAR(10) || CHAR(10) || 'bisa minta nomor HP nya saya ingin membuat website untuk desa saya.', '2021-04-19T03:52:09+07:00');