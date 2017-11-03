#ifndef __SHAWN_APPS_LEGACYAPPS_PROY_TEST1_PROCESSOR_FACTORY_H
#define __SHAWN_APPS_LEGACYAPPS_PROY_TEST1_PROCESSOR_FACTORY_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_PROY_TEST1

#include "sys/processors/processor_factory.h"

namespace shawn 
{ 
    class SimulationController; 
    class Processor;
}

namespace proy_test1
{

   class proy_test1ProcessorFactory
      : public shawn::ProcessorFactory
   {
   public:
      proy_test1ProcessorFactory();
      virtual ~proy_test1ProcessorFactory();

      virtual std::string name( void ) const throw();
      virtual std::string description( void ) const throw();
      virtual shawn::Processor* create( void ) throw();

      static void register_factory( shawn::SimulationController& ) throw();
   };

}

#endif
#endif
