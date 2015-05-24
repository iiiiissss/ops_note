




location / {
  # block one workstation
  deny    192.168.1.1;
  # allow anyone in 192.168.1.0/24
  allow   192.168.1.0/24;
  # drop rest of the world
  deny    all;
}