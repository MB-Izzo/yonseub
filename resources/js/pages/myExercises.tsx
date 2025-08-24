import { MainLayout } from '@/layouts/main-layout';
import * as ScrollArea from "@radix-ui/react-scroll-area"

type Exercise = {
    id: number;
    sentence: string;
    translation: string;
};

type WordsProps = {
    exercises: Exercise[];
};

export default function Words({ exercises }: WordsProps) {
    return (
        <>
            <MainLayout title="Your words">
                <div className='flex justify-center'>
                    {exercises.length === 0 && <div>No exercises yet. Please add some words first.</div>}
                    {exercises.length > 0 &&
                        <ScrollArea.Root className="w-full h-[500px] rounded-md border border-gray-200 dark:border-gray-700">
                            <ScrollArea.Viewport className="w-full h-full rounded-md">
                                <div className='p-2'>
                                    {exercises.map((exercise) => (
                                        <div key={exercise.id} className='mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-md'>
                                            <div className='mb-2'>
                                                <strong>Sentence:</strong> {exercise.sentence}
                                            </div>
                                            <div>
                                                <strong>Translation:</strong> {exercise.translation}
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </ScrollArea.Viewport>
                            <ScrollArea.Scrollbar orientation="vertical" className="flex select-none touch-none p-0.5 bg-gray-100 dark:bg-gray-800 transition-colors duration-[160ms] ease-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                <ScrollArea.Thumb className="flex-1 bg-gray-400 dark:bg-gray-600 rounded-[10px] relative before:content-[''] before:absolute before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2 before:w-full before:h-full before:min-w-[44px] before:min-h-[44px]" />
                            </ScrollArea.Scrollbar>
                            <ScrollArea.Corner className="bg-gray-200 dark:bg-gray-700" />
                        </ScrollArea.Root>
                    }
                </div>
            </MainLayout >
        </>
    );
}
