CREATE TABLE `lims` (
`id` int(11) NOT NULL auto_increment,
`dates` date,
`divison` varchar(30) NOT NULL,
`district` varchar(30) NOT NULL,
`upazilla` varchar(30) NOT NULL,
`names` varchar(255) NOT NULL,
`mobile` varchar(11) NOT NULL,
`holding_num` int(11) NOT NULL,

`prob_stat` MEDIUMTEXT NOT NULL,
`solution` MEDIUMTEXT NULL,

primary key(id)
);

