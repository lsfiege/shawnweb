#include "legacyapps/camino_mcorto1/camino_mcorto1_init.h"
#ifdef ENABLE_CAMINO_MCORTO1

#include "legacyapps/camino_mcorto1/camino_mcorto1_processor_factory.h"

extern "C" void init_camino_mcorto1( shawn::SimulationController& sc )
{
   camino_mcorto1::camino_mcorto1ProcessorFactory::register_factory( sc );
}

#endif
