#ifndef __SHAWN_APPS_LEGACYAPPS_CAMINO_MCORTO1_PROCESSOR_FACTORY_H
#define __SHAWN_APPS_LEGACYAPPS_CAMINO_MCORTO1_PROCESSOR_FACTORY_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_CAMINO_MCORTO1

#include "sys/processors/processor_factory.h"

namespace shawn 
{ 
    class SimulationController; 
    class Processor;
}

namespace camino_mcorto1
{

   class camino_mcorto1ProcessorFactory
      : public shawn::ProcessorFactory
   {
   public:
      camino_mcorto1ProcessorFactory();
      virtual ~camino_mcorto1ProcessorFactory();

      virtual std::string name( void ) const throw();
      virtual std::string description( void ) const throw();
      virtual shawn::Processor* create( void ) throw();

      static void register_factory( shawn::SimulationController& ) throw();
   };

}

#endif
#endif
