

--
-- Create a Database: `budget` with CHARSET = utf8mb4
-- Add the table below.
--

-- --------------------------------------------------------

--
-- Table structure for table `spending`
--

CREATE TABLE `spending` (
  `pk` int(11) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `place` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



--
-- Dumping data for table `spending`
--

INSERT INTO `spending` (`pk`, `amount`, `place`, `notes`, `category`, `date`) VALUES
(1, 15.00, 'Whole Foods', '', 'Groceries', '2015-08-30 16:16:10'),
(2, 57.46, 'Trader Joes', '', 'Groceries', '2015-08-31 01:24:44'),
(11, 4.39, 'COOP', '', 'Groceries', '2015-09-02 02:03:35'),
(10, 3.99, 'Safeway', 'Goldfish', 'Snacks', '2015-09-01 22:37:25'),
(12, 17.47, 'Skaggs', 'Shrimp!', 'Groceries', '2015-09-03 02:22:50'),
(13, 3.99, 'Feed Depot', '', 'Groceries', '2015-09-05 03:03:38'),
(14, 78.20, 'Sprouts', '', 'Groceries', '2015-09-17 21:43:59');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `spending`
--
ALTER TABLE `spending`
  ADD PRIMARY KEY (`pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `spending`
--
ALTER TABLE `spending`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1093;
COMMIT;