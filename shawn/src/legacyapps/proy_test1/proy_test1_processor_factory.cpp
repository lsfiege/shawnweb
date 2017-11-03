#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_PROY_TEST1

#include "legacyapps/proy_test1/proy_test1_processor_factory.h"
#include "legacyapps/proy_test1/proy_test1_processor.h"
#include "sys/processors/processor_keeper.h"
#include "sys/simulation/simulation_controller.h"
#include <iostream>

using namespace std;
using namespace shawn;

namespace proy_test1
{
   void
   proy_test1ProcessorFactory::
   register_factory( SimulationController& sc )
      throw()
   {
      sc.processor_keeper_w().add( new proy_test1ProcessorFactory );
   }
   
   proy_test1ProcessorFactory::
   proy_test1ProcessorFactory()
   {
      //cout << "proy_test1ProcessorFactory ctor" << &auto_reg_ << endl;
   }
   
   proy_test1ProcessorFactory::
   ~proy_test1ProcessorFactory()
   {
      //cout << "proy_test1ProcessorFactory dtor" << endl;
   }
   
   std::string
   proy_test1ProcessorFactory::
   name( void )
      const throw()
   { 
	   return "proy_test1"; 
   }
   
   std::string 
   proy_test1ProcessorFactory::
   description( void )
      const throw()
   {
      return "simple HelloWorld demo processor";
   }
   
   shawn::Processor*
   proy_test1ProcessorFactory::
   create( void )
      throw()
   {
      return new proy_test1Processor;
   }

}

#endif
