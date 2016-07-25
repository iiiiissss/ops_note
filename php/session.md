session.save_handler = redis  
session.save_path = "tcp://127.0.0.1:6379?auth=password"  

session.gc_probability = 1
session.gc_divisor = 1000
session.gc_maxlifetime = 186400