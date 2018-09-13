# Backup
docker run -v shawnweb_pgdata:/volume -v /tmp/backup:/backup --rm loomchild/volume-backup backup shawnweb_pgdata.tar.bz2

# Restore
sudo mkdir /tmp/backup && sudo cp shawnweb_pgdata.tar.bz2 /tmp/backup && sudo chmod -R 777 /tmp/backup
docker run -v shawnweb_pgdata:/volume -v /tmp/backup:/backup --rm loomchild/volume-backup restore shawnweb_pgdata.tar.bz2

# Docs
https://github.com/loomchild/volume-backup
