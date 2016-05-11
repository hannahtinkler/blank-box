<h2>How To Use</h2>  

<hr>

<h3>Contents</h3>
<a href="#section1">1. Before You Start</a>  
<a href="#section2">2. Configuring Homestead</a>  
<a href="#section3">3. Setting Up the Repository</a>  
<a href="#section4">4. Setting Up Local Databases</a> 
<a href="#section5">5. Setting Up ElasticSearch</a> 
<a href="#section6">6. Notes</a> 

<hr>

<h3 id="section1">1. Before You Start</h3>
Before you start setting up, please download and install the following if you do not already have them on your system:<br />
- <a href="https://laravel.com/docs/5.2/homestead">Homestead</a><br />

You also need to request access to the repository.

<hr>

<h3 id="section2">2. Configuring Homestead</h3>
Find your Homestead.yaml located in /C:/Users/YourName/.homestead (for Windows - Mac users fend for yourselves). Then replace the contents with:

```
---
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: C:/Directory/To/Your/Git/Repos
      to: /home/vagrant/sites

sites:
    - map: black-box.app
      to: /home/vagrant/sites/black-box/public

databases:
    - black_box

```

Replace C:/Directory/To/Your/Git/Repos with the location you plan to clone the Black Box repo to, eg C:/Sites.

<hr>

<h3 id="section3">3. Setting Up the Repository</h3>
Clone the repository to the location you changed above:
```git clone git@github.com:hannahtinkler/black-box.git```

From the root of the new directory, install the dependencies:
```
composer install
```

Copy the .env.example from the root into a file called .env

<hr>

<h3 id="section4">4. Setting Up Local Databases</h3>
Navigate to the Homestead directory. On Windows, this is located in C:/Users/YourName/Homestead. From here, SSH into the Homestead box:
```
vagrant ssh
```

Navigate into the root of the Black Box directory, eg:
```
cd sites/black-box
```

Migrate the databases and run the seeders:
```
php artisan migrate --seed
```

This will create the schema you need and insert the necessary data.

<hr>

<h3 id="section5">5. Setting Up ElasticSearch</h3>

Since ElasticSearch is based off Java, you will need install Java 8 on your Vagrant box if you have not already. You can do that by running the following:

```
sudo apt-get update
```
```
sudo apt-get install openjdk-7-jre
```
```
sudo add-apt-repository -y ppa:webupd8team/java
```
```
sudo apt-get update
```
```
sudo apt-get -y install oracle-java8-installer
```

Agree to the terms when prompted. Don't worry about reading them. You're only signing away your soul. You can verify your install by running the following command:
```
java -version
```

Next you need to download and install ElasticSearch. Again, this is mainly a paste job:
```
wget https://download.elastic.co/elasticsearch/elasticsearch/elasticsearch-2.3.2.deb
```
```
sudo dpkg -i elasticsearch-2.3.2.deb
```

You will also need to configure some of the things. Run the following command:
```
sudo vim /etc/elasticsearch/elasticsearch.yml
```

Then change/add the following config values to as below. You will also need to uncomment then (obviously).
```
node.name: "Black Box 1"
cluster.name: Cluster1
index.number_of_shards: 1
index.number_of_replicas: 0
```

Finally, start ElasticSearch and test it by running the following commands:
```
sudo service elasticsearch start
```
```
curl -X GET 'http://localhost:9200'
```

Some JSON should be output; if it is and it looks a bit like this, you win:
```
{
  "name" : "Black Box 1",
  "cluster_name" : "Cluster1",
  "version" : {
    "number" : "2.3.2",
    "build_hash" : "b9e4a6acad4008027e4038f6abed7f7dba346f94",
    "build_timestamp" : "2016-04-21T16:03:47Z",
    "build_snapshot" : false,
    "lucene_version" : "5.5.0"
  },
  "tagline" : "You Know, for Search"
}
```

<h3 id="section6">6. Notes</h3>
Any data added to the database will need to be added via seeder (located in black-box/databases/seeds) and committed to the repo. You can generate new seeders by running the following command and adding the class into black-box/databases/seeds/DatabaseSeeder.php.
```
php artisan make:seeder SeederNameSeeder
```

Use the other seeders as a template if necessary.
