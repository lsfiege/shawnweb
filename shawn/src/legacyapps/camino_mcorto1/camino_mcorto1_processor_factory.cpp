#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_CAMINO_MCORTO1

#include "legacyapps/camino_mcorto1/camino_mcorto1_processor_factory.h"
#include "legacyapps/camino_mcorto1/camino_mcorto1_processor.h"
#include "sys/processors/processor_keeper.h"
#include "sys/simulation/simulation_controller.h"
#include <iostream>

using namespace std;
using namespace shawn;

namespace camino_mcorto1
{
   void
   camino_mcorto1ProcessorFactory::
   register_factory( SimulationController& sc )
      throw()
   {
      sc.processor_keeper_w().add( new camino_mcorto1ProcessorFactory );
   }
   
   camino_mcorto1ProcessorFactory::
   camino_mcorto1ProcessorFactory()
   {
      //cout << "camino_mcorto1ProcessorFactory ctor" << &auto_reg_ << endl;
   }
   
   camino_mcorto1ProcessorFactory::
   ~camino_mcorto1ProcessorFactory()
   {
      //cout << "camino_mcorto1ProcessorFactory dtor" << endl;
   }
   
   std::string
   camino_mcorto1ProcessorFactory::
   name( void )
      const throw()
   { 
	   return "camino_mcorto1"; 
   }
   
   std::string 
   camino_mcorto1ProcessorFactory::
   description( void )
      const throw()
   {
      return "simple HelloWorld demo processor";
   }
   
   shawn::Processor*
   camino_mcorto1ProcessorFactory::
   create( void )
      throw()
   {
      return new camino_mcorto1Processor;
   }

}

#endif
