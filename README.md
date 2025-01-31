Smart Switch 
 PHP | IOT | 

<img src="./sm1.png"/>

note!!
login as admin first then add user

username = admin
password = admin

IOT Componets{
    -ESP8266(node mcu)
    -LED
    -light sensor(Photo Resistor)
    -motion sensor(hc sr501)
}

Website{
    PHP
    Bootsrap
    Css
}

Database{
    Database name = 'Appdev'

Table:

CREATE TABLE `switch` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `switch` varchar(100) NOT NULL,
  `motion` varchar(100) NOT NULL,
  `light` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unrestrict',
  `user` varchar(100) NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `switch_logs` (
  `id` int(11) NOT NULL,
  `switch_name` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'User',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `user_info` (`id`, `firstname`, `lastname`, `username`, `password`, `status`, `timestamp`) VALUES
(8, 'system', 'admin', 'admin', '$2y$10$A3EYFh5xauaoSrI6c0jeSu0OqoQNU6rc9YkpOio/1ndosQzNGISsC', 'Admin', '2025-01-05 13:40:27');


--
-- Indexes for table `switch`
--
ALTER TABLE `switch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `switch_logs`
--
ALTER TABLE `switch_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `switch`
--
ALTER TABLE `switch`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `switch_logs`
--
ALTER TABLE `switch_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;
}
