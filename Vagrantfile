Vagrant.configure('2') do |config|
    config.vm.provider :virtualbox do |vb|
        vb.name = "Mashery Wordpress Plugin"
    end
    config.vm.box = "coreos-alpha"
    config.vm.box_version = ">= 308.0.1"
    config.vm.box_url = "http://alpha.release.core-os.net/amd64-usr/current/coreos_production_vagrant.json"
    ## if using a private network, make sure you `export DOCKER_HOST=tcp://172.17.8.150:2375`
    ## if not, set it to `export DOCKER_HOST=tcp://localhost:2375`
    config.vm.network :private_network, ip: "172.17.8.150"
    config.vm.synced_folder '.', '/shared', type: 'nfs', mount_options: ['nolock,vers=3,udp,noatime,actimeo=1']
    config.vm.network :forwarded_port, guest: 2375, host: 2375, auto_correct: true # docker
    config.vm.network :forwarded_port, guest: 80, host: 8080, auto_correct: true
    config.vm.provision :file, :source => "./user-data", :destination => "/tmp/vagrantfile-user-data"
    config.vm.provision :shell, :inline => "mv /tmp/vagrantfile-user-data /var/lib/coreos-vagrant/", :privileged => true
end