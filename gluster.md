sudo apt-get install software-properties-common
sudo add-apt-repository ppa:gluster/glusterfs-3.5
sudo apt-get update
sudo apt-get install glusterfs-server

sudo apt-get install xfsprogs

#mkfs.xfs -i size=512 /dev/sdb1
#mkdir -p /export/sdb1 && mount /dev/sdb1 /export/sdb1 && mkdir -p /export/sdb1/brick
#echo "/dev/sdb1 /export/sdb1 xfs defaults 0 0"  >> /etc/fstab
#gluster volume create gv0 replica 2 node01.mydomain.net:/export/sdb1/brick node02.mydomain.net:/export/sdb1/brick

server:
mkfs.ext4 /dev/gluster

volume create testfilestore replica 2 test1:/data/gluster/testfilestore test2:/data/gluster/testfilestore force


mkfs.xfs -i size=512 /dev/gluster
mkdir -p /data/gluster/sdb1 && mount /dev/gluster /data/gluster/sdb1 && mkdir -p /data/gluster/sdb1/brick
echo "/dev/gluster /data/gluster/sdb1 xfs defaults 0 0"  >> /etc/fstab
gluster volume create testfilestore replica 2 test1:/data/gluster/sdb1/brick test2:/data/gluster/sdb1/brick


gluster volume info
gluster volume start testfilestore #stop delete

"client".
mount -t glusterfs test1:/testfilestore /mnt
mkdir -p /mnt/glusterfs/testfilestore
mount -t glusterfs test1:/testfilestore /mnt/glusterfs/testfilestore

/usr/sbin/glusterd -p /var/run/glusterd.pid
/usr/sbin/glusterfs --volfile-server=test1 --volfile-id=/testfilestore /mnt/glusterfs/testfilestore


for i in `seq -w 1 100`; do cp -rp /var/log/messages /mnt/copy-test-$i; done


gluster help
gluster peer help     //datach 
gluster volume help      gluster volume remove-brick testvol g132:/data/data01




volume info [all|<VOLNAME>] - list information of all volumes
volume create <NEW-VOLNAME> [stripe <COUNT>] [replica <COUNT>] [transport <tcp|rdma|tcp,rdma>] <NEW-BRICK>?<vg_name>... [force] - create a new volume of specified type with mentioned bricks
volume delete <VOLNAME> - delete volume specified by <VOLNAME>
volume start <VOLNAME> [force] - start volume specified by <VOLNAME>
volume stop <VOLNAME> [force] - stop volume specified by <VOLNAME>
volume add-brick <VOLNAME> [<stripe|replica> <COUNT>] <NEW-BRICK> ... [force] - add brick to volume <VOLNAME>
volume remove-brick <VOLNAME> [replica <COUNT>] <BRICK> ... [start|stop|status|commit|force] - remove brick from volume <VOLNAME>
volume rebalance <VOLNAME> [fix-layout] {start|stop|status} [force] - rebalance operations
volume replace-brick <VOLNAME> <BRICK> <NEW-BRICK> {start [force]|pause|abort|status|commit [force]} - replace-brick operations
volume set <VOLNAME> <KEY> <VALUE> - set options for volume <VOLNAME>
volume help - display help for the volume command
volume log rotate <VOLNAME> [BRICK] - rotate the log file for corresponding volume/brick
volume sync <HOSTNAME> [all|<VOLNAME>] - sync the volume information from a peer
volume reset <VOLNAME> [option] [force] - reset all the reconfigured options
volume geo-replication [<VOLNAME>] [<SLAVE-URL>] {create [push-pem] [force]|start [force]|stop [force]|config|status [detail]|delete} [options...] - Geo-sync operations
volume profile <VOLNAME> {start|stop|info [nfs]} - volume profile operations
volume quota <VOLNAME> {enable|disable|list [<path> ...]|remove <path>| default-soft-limit <percent>} |
volume quota <VOLNAME> {limit-usage <path> <size> [<percent>]} |
volume quota <VOLNAME> {alert-time|soft-timeout|hard-timeout} {<time>} - quota translator specific operations
volume top <VOLNAME> {open|read|write|opendir|readdir|clear} [nfs|brick <brick>] [list-cnt <value>] |
volume top <VOLNAME> {read-perf|write-perf} [bs <size> count <count>] [brick <brick>] [list-cnt <value>] - volume top operations
volume status [all | <VOLNAME> [nfs|shd|<BRICK>|quotad]] [detail|clients|mem|inode|fd|callpool|tasks] - display status of all or specified volume(s)/brick
volume heal <VOLNAME> [{full | statistics {heal-count {replica <hostname:brickname>}} |info {healed | heal-failed | split-brain}}] - self-heal commands on volume specified by <VOLNAME>
volume statedump <VOLNAME> [nfs|quotad] [all|mem|iobuf|callpool|priv|fd|inode|history]... - perform statedump on bricks
volume list - list all volumes in cluster
volume clear-locks <VOLNAME> <path> kind {blocked|granted|all}{inode [range]|entry [basename]|posix [range]} - Clear locks held on path
peer probe <HOSTNAME> - probe peer specified by <HOSTNAME>
peer detach <HOSTNAME> [force] - detach peer specified by <HOSTNAME>
peer status - list status of peers
peer help - Help command for peer 
pool list - list all the nodes in the pool (including localhost)
quit - quit
help - display command options
exit - exit
