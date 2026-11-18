CREATE TABLE IF NOT EXISTS workers (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  full_name     VARCHAR(100) NOT NULL,
  phone         VARCHAR(20)  NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role          ENUM('worker','manager') NOT NULL DEFAULT 'worker',
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Where they work (the geofence: centre point + radius)
CREATE TABLE IF NOT EXISTS sites (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  name      VARCHAR(100) NOT NULL,
  latitude  DECIMAL(9,6) NOT NULL,
  longitude DECIMAL(9,6) NOT NULL,
  radius_m  INT NOT NULL DEFAULT 100
);

-- Every arrival and departure
CREATE TABLE IF NOT EXISTS attendance_events (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  worker_id   INT NOT NULL,
  site_id     INT NOT NULL,
  event_type  ENUM('IN','OUT') NOT NULL,
  event_time  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- set by the SERVER
  latitude    DECIMAL(9,6) NOT NULL,
  longitude   DECIMAL(9,6) NOT NULL,
  accuracy_m  DECIMAL(7,2),
  distance_m  DECIMAL(8,2),
  FOREIGN KEY (worker_id) REFERENCES workers(id),
  FOREIGN KEY (site_id)   REFERENCES sites(id)
);