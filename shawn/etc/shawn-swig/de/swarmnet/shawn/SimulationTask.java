/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.29
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */

package de.swarmnet.shawn;

public class SimulationTask extends KeeperManaged {
  private long swigCPtr;

  protected SimulationTask(long cPtr, boolean cMemoryOwn) {
    super(ShawnJNI.SWIGSimulationTaskUpcast(cPtr), cMemoryOwn);
    swigCPtr = cPtr;
  }

  protected static long getCPtr(SimulationTask obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public void delete() {
    if(swigCPtr != 0 && swigCMemOwn) {
      swigCMemOwn = false;
      ShawnJNI.delete_SimulationTask(swigCPtr);
    }
    swigCPtr = 0;
    super.delete();
  }

  public void run(SimulationController arg0) {
    ShawnJNI.SimulationTask_run(swigCPtr, SimulationController.getCPtr(arg0));
  }

  public SWIGTYPE_p_shawn__SimulationTask__ResultSet__iterator begin_results() {
    return new SWIGTYPE_p_shawn__SimulationTask__ResultSet__iterator(ShawnJNI.SimulationTask_begin_results(swigCPtr), true);
  }

  public SWIGTYPE_p_shawn__SimulationTask__ResultSet__iterator end_results() {
    return new SWIGTYPE_p_shawn__SimulationTask__ResultSet__iterator(ShawnJNI.SimulationTask_end_results(swigCPtr), true);
  }

}
