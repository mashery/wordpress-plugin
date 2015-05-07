Vagrant.configure('2') do |config|
    config.ssh.insert_key = false
    config.vm.provider :virtualbox do |vb|
        vb.name = "Mashery Wordpress Plugin"
        vb.check_guest_additions = false
        vb.functional_vboxsf = false
        vb.gui = false
        vb.memory = 1024
        vb.cpus = 1
    end
    config.vm.box = "coreos-alpha"
    config.vm.box_version = ">= 308.0.1"
    config.vm.box_url = "http://alpha.release.core-os.net/amd64-usr/current/coreos_production_vagrant.json"
    config.vm.network :private_network, ip: "172.17.8.150"
    config.vm.network :forwarded_port, guest: 2375, host: 2375, auto_correct: true # docker
    config.vm.network :forwarded_port, guest: 80, host: 8080, auto_correct: true
    config.vm.synced_folder ENV['HOME'], ENV['HOME'], type: 'nfs', mount_options: ['nolock,vers=3,udp'] # ,noatime,actimeo=1
    config.vm.provision :file, :source => "./user-data.yml", :destination => "/tmp/vagrantfile-user-data"
    config.vm.provision :shell, :inline => "mv /tmp/vagrantfile-user-data /var/lib/coreos-vagrant/", :privileged => true
end
