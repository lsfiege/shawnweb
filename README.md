# ShawnWEB: The fast, highly customizable sensor network simulator, ¡Now Dockerized!
## Abstract
Shawn [1] is a discrete event simulator for sensor networks. Due to its high customizability, it is extremely fast but can be tuned to any accuracy that is required by the simulation or application.

## Original Project and Documentation
* https://github.com/itm/shawn
* https://github.com/itm/shawn/wiki

## How to run it
* Install [Docker and docker-compose](https://docs.docker.com/install)
* Clone this repo
* Import ``shawnweb_pgdata.tar.bz2`` as ``shawnweb_pgdata`` docker volume
* CD with terminal/console to shawnweb path and run ``docker-compose up -d``
* Access it in http://localhost:8888 with username and pwd ``test``
* Can stop containers by running ``docker-compose down``

## Features
* Create and run WSN simulations with easy scenario specifications
* Optionally, you can add visual style settings to nodes and edges
* Simple compile and run, export and download results
* Manage scenarios: import and export simulation scenarios with original shawn xml file

### Known issues
* Problems regarding the resolution of paths and directories in Windows operating system, open pull requests ;)
