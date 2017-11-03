#include "legacyapps/proy_test1/proy_test1_init.h"
#ifdef ENABLE_PROY_TEST1

#include "legacyapps/proy_test1/proy_test1_processor_factory.h"

extern "C" void init_proy_test1( shawn::SimulationController& sc )
{
   proy_test1::proy_test1ProcessorFactory::register_factory( sc );
}

#endif
