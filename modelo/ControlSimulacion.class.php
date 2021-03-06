<?php

/**
 * Description of ControSimulacion
 *
 * @author hernix
 */


//importa la clase persistente
require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'ORM'.DIRECTORY_SEPARATOR.'redbeam.php');

class ControlSimulacion
{

    private $count = 0;
    private $range = 0;
    private $width = 0;
    private $height = 0;
    private $seed = 0;
    private $maxIterations = 0;

    private $nombreArchivoConf = "";
    private $proyecto = null;

    public function insertarParametro()
    {
        return $resultado = true;

    }

    public function buscarParametro($parametro = "")
    {
        return $posicion = 0;
    }

    public function getCount()
    {
        $this->count;
    }

    public function getRange()
    {
        $this->range;
    }


    public function getWidth()
    {
        $this->width;
    }

    public function getHeight()
    {
        $this->height;
    }

    public function getSeed()
    {
        $this->seed;
    }

    public function getMaxIterations()
    {
        $this->maxIterations;
    }

    public function getNombreArchivoConf()
    {
        $this->nombreArchivoConf;
    }

    public function getProyecto()
    {
        $this->proyecto;
    }


    public function setCount($unCount = 0)
    {
        $this->count = $unCount;
    }

    public function setRange($unRange = 0)
    {
        $this->range = $unRange;
    }

    public function setWidth($unWidth = 0)
    {
        $this->width = $unWidth;
    }

    public function setHeight($unHeight = 0)
    {
        $this->height = $unHeight;
    }

    public function setSeed($unSeed = 0)
    {
        $this->seed = $unSeed;
    }

    public function setMaxIterations($maxIterations = 0)
    {
        $this->maxIterations = $maxIterations;
    }

    public function setNombreArchivoConf($unNombreArchivoConf = "")
    {
        $this->nombreArchivoConf = $unNombreArchivoConf;
    }

    public function setProyecto($unProyecto = null)
    {
        $this->proyecto = $unProyecto;
    }

    public function obtenerArchivosConf($proyecto_id)
    {
        //obtiene el proyecto de la db    
        $proyecto = R::load('proyecto', $proyecto_id);
        $path = $proyecto->path;
        $arr_archivos = scandir($path);
        $nombres_archivos_conf = [];
        foreach ($arr_archivos as $nombre_archivo) {
            if ('.conf' == (strstr($nombre_archivo, '.conf'))) {
                $nombres_archivos_conf[] = $nombre_archivo;
            }

        }

        return $nombres_archivos_conf;
    }

    public function obtenerParamVisProyecto($proyecto_id, $nombre_arch_conf)
    {
        $config = R::getAll('SELECT * FROM vis_proyecto_config WHERE proyecto_id = ? and file = ? ',
            [$proyecto_id, $nombre_arch_conf]);

        if (count($config) > 0) {
            $config = (object)$config[0];
            $proyect_config_id = $config->id;

            $vis_configs = R::getAll('SELECT * FROM vis_proyecto_preset WHERE vis_proyecto_archivo_id = ? ',
                [$proyect_config_id]);

            if (count($vis_configs) > 0) {
                return $vis_configs;
            }

            return [];
        }

        return [];
    }

    public function obtenerSnapshotsUser($usuario_id)
    {
        $snapshots = R::getAll('SELECT * FROM vis_proyecto_snapshots WHERE usuario_id = ? ',
            [$usuario_id]);

        if (count($snapshots) > 0) {
            return $snapshots;
        }

        return [];
    }

    public function cargarWorld($proyecto_id, $nombre_arch_conf)
    {
        $config = R::getAll('SELECT * FROM vis_proyecto_config WHERE proyecto_id = ? and file = ? ',
            [$proyecto_id, $nombre_arch_conf]);

        if (count($config) > 0) {
            $config = (object)$config[0];
            $proyect_config_id = $config->id;

            $world = R::getAll('SELECT * FROM vis_proyecto_file_world WHERE vis_proyecto_archivo_id = ?',
                [$proyect_config_id]);

            if (count($world) > 0) {
                $world = (object)$world[0];

                return [
                    'count'  => $world->count,
                    'width'  => $world->world_width,
                    'height' => $world->world_height,
                    'seed'   => $world->seed,
                ];
            }
        }

        return null;
    }

    /**
     * Obtiene los parametros ingresados en un archivo de configuracion .conf de un determinado proyecto
     * @param type $nombre_arch_conf nombre del archivo de donde se desea obtener los parametros
     */
    public function obtenerParamArchivoConf($proyecto_id, $nombre_arch_conf)
    {
        $arr_parametros = [];
        $proyecto = R::load('proyecto', $proyecto_id);
        $path = $proyecto->path;
        $arch_conf = fopen($path.DIRECTORY_SEPARATOR.$nombre_arch_conf, "r+") or die("Unable to open file!");

        $count_buscar = "count=";
        $range_buscar = "range=";
        $rect_world_width_buscar = "width=";
        $rect_world_height_buscar = "height=";
        $seed_buscar = "seed=";
        $max_iterations_buscar = "max_iterations=";
        $edge_model_buscar = "edge_model=";
        $comm_model_buscar = "comm_model=";
        $transm_model_buscar = "transm_model=";

        $arr_parametros["count"] = "";
        $arr_parametros["range"] = "";
        $arr_parametros["rect_world_width"] = "";
        $arr_parametros["rect_world_height"] = "";
        $arr_parametros["seed"] = "";
        $arr_parametros["max_iterations"] = "";
        $arr_parametros["edge_model"] = "0";
        $arr_parametros["comm_model"] = "0";
        $arr_parametros["transm_model"] = "0";

        while (!feof($arch_conf)) {
            $linea = fgets($arch_conf);

            //reemplaza el final de linea por un espacio en blanco para realizar la busqueda de parametros
            $linea = str_replace(PHP_EOL, " ", $linea);
            //echo $linea . '<br>';
            $count = $this->obtenerStringParametro($linea, $count_buscar, " ");
            if ($count <> "") {
                $arr_parametros["count"] = $count;
            }

            $range = $this->obtenerStringParametro($linea, $range_buscar, " ");

            if ($range <> "") {
                $arr_parametros["range"] = $range;
            }

            $rect_world_width = $this->obtenerStringParametro($linea, $rect_world_width_buscar, " ");
            if ($rect_world_width <> "") {
                $arr_parametros["rect_world_width"] = $rect_world_width;
            }

            $rect_world_height = $this->obtenerStringParametro($linea, $rect_world_height_buscar, " ");
            if ($rect_world_height <> "") {
                $arr_parametros["rect_world_height"] = $rect_world_height;
            }

            $seed = $this->obtenerStringParametro($linea, $seed_buscar, " ");
            if ($seed <> "") {
                $arr_parametros["seed"] = $seed;
            }

            $max_iterations = $this->obtenerStringParametro($linea, $max_iterations_buscar, " ");
            if ($max_iterations <> "") {
                $arr_parametros["max_iterations"] = $max_iterations;
            }

            $edge_model = $this->obtenerStringParametro($linea, $edge_model_buscar, " ");

            if ($edge_model <> "") {
                $arr_parametros["edge_model"] = $edge_model;
            }

            $comm_model = $this->obtenerStringParametro($linea, $comm_model_buscar, " ");

            if ($comm_model <> "") {
                $arr_parametros["comm_model"] = $comm_model;
            }

            $transm_model = $this->obtenerStringParametro($linea, $transm_model_buscar, " ");

            if ($transm_model <> "") {
                $arr_parametros["transm_model"] = $transm_model;
            }

        }

        fclose($arch_conf);

        return $arr_parametros;
    }

    function obtenerStringParametro($string, $start, $end)
    {
        $string = " ".$string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return "";
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

    public function guardarParamArchConfVis(
        $proyecto_id,
        $nombre_arch_conf,
        $export_scenario,
        $vis_configs,
        $load_snapshot,
        $id_snapshot,
        $count,
        $range,
        $world_width,
        $world_height,
        $seed,
        $max_iterations,
        $edge_model,
        $comm_model,
        $transm_model
    ) {
        try {
            $arr_parametros = [];
            $proyecto = R::load('proyecto', $proyecto_id);
            $path = $proyecto->path;
            $source = $path.DIRECTORY_SEPARATOR.$nombre_arch_conf;

            $descriptorspec = [
                0 => ["pipe", "r"], // stdin
                1 => ["pipe", "w"], // stdout
                2 => ["pipe", "w"] // stderr
            ];

            // Limpiar archivo
            $comando1 = "cp /dev/null {$source}";
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            // Inicializar mundo
            $comando1 = "echo 'prepare_world edge_model={$edge_model} comm_model={$comm_model} range={$range}' > $source";
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            $this->saveProjectVisConfigs($proyecto_id, $nombre_arch_conf, $vis_configs);

            //Comprobar si debe cargar escenario
            if ($load_snapshot and !is_null($id_snapshot)) {
                // Cargar escenario
                $snapshot = R::load('vis_proyecto_snapshots', $id_snapshot);
                $comando2 = "echo 'load_world file={$snapshot->world_filename} snapshot={$snapshot->snapshot_id} processors={$proyecto->nombre}' >> $source";
                $process2 = proc_open($comando2, $descriptorspec, $pipes2);
                $this->cerrarProceso($process2);

            } else {
                // Generar escenario
                $comando1 = "echo 'random_seed action=set seed={$seed}' >> $source";
                $process1 = proc_open($comando1, $descriptorspec, $pipes1);
                $this->cerrarProceso($process1);

                $comando1 = "echo 'rect_world width={$world_width} height={$world_height} count={$count} processors={$proyecto->nombre}' >> $source";
                $process1 = proc_open($comando1, $descriptorspec, $pipes1);
                $this->cerrarProceso($process1);

                // Guardar escenario en db
                $this->saveWorldSettings(
                    $proyecto_id,
                    $nombre_arch_conf,
                    $count,
                    $range,
                    $world_width,
                    $world_height,
                    $seed,
                    $max_iterations,
                    $edge_model,
                    $comm_model,
                    $transm_model
                );
            }
            // obtener cant iteraciones y agregar simulation max_iterations=X
            $comando1 = "echo 'simulation max_iterations={$max_iterations}' >> $source";
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            // agregar linea connectivity
            $comando1 = "echo 'connectivity' >> $source";
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            // agregar linea dump_transmission_stats
            $comando1 = "echo 'dump_transmission_stats' >> $source";
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            // Set VIS initialization
            $comando1 = 'find '.$source.' -type f -exec sed -i '."'".'$a vis=my_visualization'."'".' {} \;';
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            $comando2 = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_create'."'".' {} \;';
            $process2 = proc_open($comando2, $descriptorspec, $pipes1);
            $this->cerrarProceso($process2);

            $comando3 = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_create_edges source_regex=.* target_regex=.*'."'".' {} \;';
            $process3 = proc_open($comando3, $descriptorspec, $pipes1);
            $this->cerrarProceso($process3);

            // Set VIS configurations
            $i = 1;
            foreach ($vis_configs as $vis) {
                $node = "node.default.v{$i}.*";
                $edge = "edge.default.v{$i}.*";

                // Node Size
                if (!is_null($vis->node_size)):
                    $comando = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_constant_double value='.$vis->node_size.' elem_regex='.$node.' prop=size prio=1'."'".' {} \;';
                    $process = proc_open($comando, $descriptorspec, $pipes1);
                    $this->cerrarProceso($process);
                endif;

                // Node Color
                if (!is_null($vis->node_color_rgb)):
                    $comando = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_constant_vec x='.$vis->node_color_x.' y='.$vis->node_color_y.' z='.$vis->node_color_z.' elem_regex='.$node.' prop=background prio=1'."'".' {} \;';
                    $process = proc_open($comando, $descriptorspec, $pipes1);
                    $this->cerrarProceso($process);
                endif;

                // Node shape
                if (!is_null($vis->node_shape)):
                    $comando = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_constant_int value='.$vis->node_shape.' elem_regex='.$node.' prop=shape prio=1'."'".' {} \;';
                    $process = proc_open($comando, $descriptorspec, $pipes1);
                    $this->cerrarProceso($process);
                endif;

                // Line width
                if (!is_null($vis->edge_size)):
                    $comando = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_constant_double value='.$vis->edge_size.' elem_regex='.$edge.' prop=line_width prio=1'."'".' {} \;';
                    $process = proc_open($comando, $descriptorspec, $pipes1);
                    $this->cerrarProceso($process);
                endif;

                // Line color
                if (!is_null($vis->edge_color_rgb)):
                    $comando = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_constant_vec x='.$vis->edge_color_x.' y='.$vis->edge_color_y.' z='.$vis->edge_color_z.' elem_regex='.$edge.' prop=color prio=1'."'".' {} \;';
                    $process = proc_open($comando, $descriptorspec, $pipes1);
                    $this->cerrarProceso($process);
                endif;

                $i++;
            }
            unset($i);

            // Set VIS Camera
            $comando1 = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_simple_camera'."'".' {} \;';
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            // Finalize VIS
            $comando1 = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_single_snapshot'."'".' {} \;';
            $process1 = proc_open($comando1, $descriptorspec, $pipes1);
            $this->cerrarProceso($process1);

            $comando2 = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_single_snapshot writer=ps'."'".' {} \;';
            $process2 = proc_open($comando2, $descriptorspec, $pipes1);
            $this->cerrarProceso($process2);

            $comando3 = 'find '.$source.' -type f -exec sed -i '."'".'$a vis_single_snapshot writer=png'."'".' {} \;';
            $process3 = proc_open($comando3, $descriptorspec, $pipes1);
            $this->cerrarProceso($process3);

            if ($export_scenario):
                $timestamp = $this->getTimestamp();
                $snapshot_id = "id:{$proyecto_id}-{$timestamp}";
                $world_filename = "world-{$proyecto_id}_{$timestamp}_{$nombre_arch_conf}.xml";

                $res = $this->saveSnapshotToFile($proyecto_id, $nombre_arch_conf, $snapshot_id, $world_filename);

                if ($res == false) {
                    throw new Exception('Error saving world');
                }

                $comando4 = 'find '.$source.' -type f -exec sed -i '."'".'$a save_world file='.$world_filename.' snapshot='.$snapshot_id."'".' {} \;';
                $process4 = proc_open($comando4, $descriptorspec, $pipes1);
                $this->cerrarProceso($process4);
            endif;


        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function saveWorldSettings(
        $proyecto_id,
        $nombre_arch_conf,
        $count,
        $range,
        $world_width,
        $world_height,
        $seed,
        $max_iterations,
        $edge_model,
        $comm_model,
        $transm_model
    ) {
        $config = R::getAll('SELECT * FROM vis_proyecto_config WHERE proyecto_id = ? and file = ? ',
            [$proyecto_id, $nombre_arch_conf]);

        if (count($config) > 0) {
            $config = (object)$config[0];
            $proyect_config_id = $config->id;

            $config = R::getAll('SELECT * FROM vis_proyecto_file_world WHERE vis_proyecto_archivo_id = ?',
                [$proyect_config_id]);

            if (count($config) > 0) {
                $config = (object)$config[0];
                $world_config = R::load('vis_proyecto_file_world', $config->id);
            } else {
                $world_config = R::xdispense('vis_proyecto_file_world');
                $world_config->vis_proyecto_archivo_id = $proyect_config_id;
            }

            $world_config->count = $count;
            $world_config->range = $range;
            $world_config->world_width = $world_width;
            $world_config->world_height = $world_height;
            $world_config->seed = $seed;
            $world_config->max_iterations = $max_iterations;
            $world_config->edge_model = $edge_model;
            $world_config->comm_model = $comm_model;
            $world_config->transm_model = $transm_model;

            R::store($world_config);
        }
    }

    public function saveProjectVisConfigs($proyecto_id, $nombre_arch_conf, $vis_configs)
    {
        $config = R::getAll('SELECT * FROM vis_proyecto_config WHERE proyecto_id = ? and file = ? ',
            [$proyecto_id, $nombre_arch_conf]);

        if (count($config) > 0) {
            $config = (object)$config[0];
            $proyect_config_id = $config->id;
        } else {
            $proyecto = R::load('proyecto', $proyecto_id);

            $data = R::xdispense('vis_proyecto_config');
            $data->proyecto_id = $proyecto_id;
            $data->file = $nombre_arch_conf;
            $data->path = $proyecto->path;
            $data->usuario_id = $_SESSION['usuario_id'];

            $proyect_config_id = R::store($data);
        }

        foreach ($vis_configs as $vis) {

            if (is_null($vis->id)) {
                //new preset
                $data = R::xdispense('vis_proyecto_preset');
                $data->vis_proyecto_archivo_id = $proyect_config_id;

                $data->node_color_rgb = $vis->node_color_rgb;
                $data->node_color_x = $vis->node_color_x;
                $data->node_color_y = $vis->node_color_y;
                $data->node_color_z = $vis->node_color_z;
                $data->node_size = $vis->node_size;
                $data->node_shape = $vis->node_shape;
                $data->node_edge_color_rgb = $vis->edge_color_rgb;
                $data->node_edge_color_x = $vis->edge_color_x;
                $data->node_edge_color_y = $vis->edge_color_y;
                $data->node_edge_color_z = $vis->edge_color_z;
                $data->node_edge_line_width = $vis->edge_size;

                R::store($data);
            }
        }

        return false;
    }

    public function saveSnapshotToFile($proyecto_id, $proyecto_file, $snapshot_id, $world_filename)
    {
        $data = R::xdispense('vis_proyecto_snapshots');
        $data->proyecto_id = $proyecto_id;
        $data->proyecto_file = $proyecto_file;
        $data->snapshot_id = $snapshot_id;
        $data->world_filename = $world_filename;
        $data->usuario_id = $_SESSION['usuario_id'];

        $id = R::store($data);

        if ($id) {
            return true;
        }

        return false;
    }

    public function cargarPreset($preset_id)
    {
        $preset = R::load('vis_usuario_preset', $preset_id);

        return $preset->getProperties();
    }

    public function eliminarPreset($preset_id)
    {
        $result = R::exec("DELETE FROM vis_usuario_preset WHERE id = $preset_id");

        if ($result) {
            return true;
        }

        return false;
    }

    public function eliminarPresetProyecto($preset_id)
    {
        $result = R::exec("DELETE FROM vis_proyecto_preset WHERE id = $preset_id");

        if ($result) {
            return true;
        }

        return false;
    }

    public function guardarPreset(
        $preset_name,
        $color,
        $color_x,
        $color_y,
        $color_z,
        $size,
        $shape,
        $edge_color,
        $edge_color_x,
        $edge_color_y,
        $edge_color_z,
        $edge_width
    ) {
        $preset = R::xdispense('vis_usuario_preset');
        $preset->preset_name = $preset_name;
        $preset->node_color_rgb = $color;
        $preset->node_color_x = $color_x;
        $preset->node_color_y = $color_y;
        $preset->node_color_z = $color_z;
        $preset->node_size = $size;
        $preset->node_shape = $shape;
        $preset->node_edge_color_rgb = $edge_color;
        $preset->node_edge_color_x = $edge_color_x;
        $preset->node_edge_color_y = $edge_color_y;
        $preset->node_edge_color_z = $edge_color_z;
        $preset->node_edge_line_width = $edge_width;

        $usuario_id = $_SESSION['usuario_id'];
        $preset->usuario_id = $usuario_id;

        $id = R::store($preset);

        if ($id) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    protected function getTimestamp()
    {
        $now = new DateTime();

        return $now->getTimestamp();
    }

    /**
     * Duerme la ejecucion esperando la finalizacion de un proceso para su cierre
     * @param type $process
     */
    public function cerrarProceso($process)
    {
        $status = proc_get_status($process);
        while ($status["running"] == true) {
            sleep(1);
            $status = proc_get_status($process);
        }
        proc_close($process);

    }
}