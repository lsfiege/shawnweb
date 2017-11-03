/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.29
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */

package de.swarmnet.shawn;

public class SimulationController {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected SimulationController(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(SimulationController obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public void delete() {
    if(swigCPtr != 0 && swigCMemOwn) {
      swigCMemOwn = false;
      ShawnJNI.delete_SimulationController(swigCPtr);
    }
    swigCPtr = 0;
  }

  public SimulationController() {
    this(ShawnJNI.new_SimulationController(), true);
  }

  public SimulationEnvironment environment() {
    return new SimulationEnvironment(ShawnJNI.SimulationController_environment(swigCPtr), false);
  }

  public SimulationEnvironment environment_w() {
    return new SimulationEnvironment(ShawnJNI.SimulationController_environment_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__SimulationTaskKeeper simulation_task_keeper() {
    return new SWIGTYPE_p_shawn__SimulationTaskKeeper(ShawnJNI.SimulationController_simulation_task_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__SimulationTaskKeeper simulation_task_keeper_w() {
    return new SWIGTYPE_p_shawn__SimulationTaskKeeper(ShawnJNI.SimulationController_simulation_task_keeper_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__ProcessorKeeper processor_keeper() {
    return new SWIGTYPE_p_shawn__ProcessorKeeper(ShawnJNI.SimulationController_processor_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__ProcessorKeeper processor_keeper_w() {
    return new SWIGTYPE_p_shawn__ProcessorKeeper(ShawnJNI.SimulationController_processor_keeper_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__RandomVariableKeeper random_variable_keeper() {
    return new SWIGTYPE_p_shawn__RandomVariableKeeper(ShawnJNI.SimulationController_random_variable_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__RandomVariableKeeper random_variable_keeper_w() {
    return new SWIGTYPE_p_shawn__RandomVariableKeeper(ShawnJNI.SimulationController_random_variable_keeper_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__EdgeModelKeeper edge_model_keeper() {
    return new SWIGTYPE_p_shawn__EdgeModelKeeper(ShawnJNI.SimulationController_edge_model_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__EdgeModelKeeper edge_model_keeper_w() {
    return new SWIGTYPE_p_shawn__EdgeModelKeeper(ShawnJNI.SimulationController_edge_model_keeper_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__TransmissionModelKeeper transmission_model_keeper() {
    return new SWIGTYPE_p_shawn__TransmissionModelKeeper(ShawnJNI.SimulationController_transmission_model_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__TransmissionModelKeeper transmission_model_keeper_w() {
    return new SWIGTYPE_p_shawn__TransmissionModelKeeper(ShawnJNI.SimulationController_transmission_model_keeper_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__CommunicationModelKeeper communication_model_keeper() {
    return new SWIGTYPE_p_shawn__CommunicationModelKeeper(ShawnJNI.SimulationController_communication_model_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__CommunicationModelKeeper communication_model_keeper_w() {
    return new SWIGTYPE_p_shawn__CommunicationModelKeeper(ShawnJNI.SimulationController_communication_model_keeper_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__DistanceEstimateKeeper distance_estimate_keeper() {
    return new SWIGTYPE_p_shawn__DistanceEstimateKeeper(ShawnJNI.SimulationController_distance_estimate_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__DistanceEstimateKeeper distance_estimate_keeper_w() {
    return new SWIGTYPE_p_shawn__DistanceEstimateKeeper(ShawnJNI.SimulationController_distance_estimate_keeper_w(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__TagFactoryKeeper tag_factory_keeper() {
    return new SWIGTYPE_p_shawn__TagFactoryKeeper(ShawnJNI.SimulationController_tag_factory_keeper(swigCPtr), false);
  }

  public SWIGTYPE_p_shawn__TagFactoryKeeper tag_factory_keeper_w() {
    return new SWIGTYPE_p_shawn__TagFactoryKeeper(ShawnJNI.SimulationController_tag_factory_keeper_w(swigCPtr), false);
  }

  public boolean has_world() {
    return ShawnJNI.SimulationController_has_world(swigCPtr);
  }

  public World world_w() {
    return new World(ShawnJNI.SimulationController_world_w(swigCPtr), false);
  }

  public World world() {
    return new World(ShawnJNI.SimulationController_world(swigCPtr), false);
  }

  public void set_world(World arg0) {
    ShawnJNI.SimulationController_set_world(swigCPtr, World.getCPtr(arg0));
  }

  public void add_keeper(SWIGTYPE_p_shawn__HandleKeeperBase arg0) {
    ShawnJNI.SimulationController_add_keeper(swigCPtr, SWIGTYPE_p_shawn__HandleKeeperBase.getCPtr(arg0));
  }

}
